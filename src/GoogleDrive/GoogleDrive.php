<?php

namespace App\GoogleDrive;

/**
*   Google Drive Class
*/
class GoogleDrive
{

  function __construct()
  {
    $this->appName    = 'Activeforce';
    $this->secretPath =  __DIR__ . '/secrets/credentials.json';
    // debug($this->secretPath);
    $this->scopes = \Google_Service_Drive::DRIVE_METADATA_READONLY;
    $this->accessType = 'offline';
  }

  /**
   * Returns an authorized API client.
   * @return Google_Client the authorized client object
   */
  protected function getClient()
  {
      $client = new \Google_Client();
      $client->setApplicationName($this->appName);
      $client->setScopes($this->scopes);
      $client->setAuthConfig($this->secretPath);
      $client->setAccessType($this->accessType);

      // Load previously authorized credentials from a file.
      $credentialsPath = __DIR__ . '/secrets/token.json';
      $accessToken = json_decode(file_get_contents($credentialsPath), true);
      // debug($accessToken);
      $client->setAccessToken($accessToken);

      // Refresh the token if it's expired.
      // debug($client->isAccessTokenExpired());
      if ($client->isAccessTokenExpired()) {
          $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
          // debug($client->getAccessToken());
          file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
      }
      return $client;
  }

  function uploadFile($filePath, $fileName) {
    // debug($filePath);
    // debug($fileName);
    $this->client = $this->getClient();
    $service = new \Google_Service_Drive($this->client);
    $folderMetadata = [
      'q' =>  "mimeType = 'application/vnd.google-apps.folder' and trashed = false and name = 'ActiveforceUploads'"
    ];
    $folders = $service->files->listFiles($folderMetadata);
    // debug($folders->files);
    foreach ($folders->files as $file) {
      // debug($file->id);
      $folderId = $file->id;
    }

    if (isset($folderId)) {
      // debug($service);
      $fileMetadata = new \Google_Service_Drive_DriveFile([
        'name' => $fileName,
        'parents' => array($folderId)
      ]);
      // debug($fileMetadata);
      $content = file_get_contents($filePath);
      $file = $service->files->create(
        $fileMetadata,
        array(
          'data' => $content,
          'mimeType' => 'image/jpeg',
          'uploadType' => 'multipart',
          'fields' => 'id, webViewLink'
        )
      );
      // debug($file);

      $userPermission = new \Google_Service_Drive_Permission(array(
          'type' => 'anyone',
          'role' => 'reader',
          'value' => 'default'
      ));

      $request = $service->permissions->create(
        $file->id,
        $userPermission,
        array(
          'fields' => 'id'
        )
      );
      // debug($request);

      return $file;
    }

    return null;
  }
}
