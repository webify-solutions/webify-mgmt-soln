<?php

namespace App\Notification;

use Cake\Core\Configure;
Use Cake\Http\Client;

/**
*   Mobile Notification Class
*/
class MobileNotification
{
  public $apiConfiguration;

  public function __construct() {
    $this->apiConfiguration = Configure::read('APIs.mobile');
  }

  public function send($title, $body, $deviceToken, $customFields = []) {
    if ($deviceToken === null) {
      return false;
    }

    $message = [
      'title' => $title,
      'body'=> $body,
      'device_token' => $deviceToken
    ];
    $message = array_merge($message, $customFields);

    $http = new Client([
      'headers' => [
        'Content-Type' => 'application/json',
        'X-Token' => $this->apiConfiguration['token']
      ]
    ]);

    $url = $this->apiConfiguration['protocol'] . '://' . $this->apiConfiguration['host']
            . '/' . $this->apiConfiguration['version'] . '/' . 'notifications';

    $response = $http->post($url, $message);
    $result = $response->code;
    unset($http);

    // debug($result);
    if ($result !== 200) {
      return false;
    }

    return true;
  }
}
