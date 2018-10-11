<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Customers'), ['collector' => 'Customer', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customer form large-9 medium-8 columns content">
  <?= $this->Form->create($customer) ?>
  <fieldset>
    <legend><?= __('Add Customer') ?></legend>
    <?php
      if ($organization != null) {
          echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
      }
      echo $this->Form->control('name');
      // echo $this->Form->control('title');
      echo $this->Form->control('phone');
      echo $this->Form->control('active');
      echo $this->Form->control('group_id', ['options' => $group, 'empty' => true]);
      echo $this->Form->control('email', ['type' => 'email']);
      echo $this->Form->control('address');
      echo '<div style="display:none">';
      	echo $this->Form->control('latitude', ['id' => 'latitude']);
      	echo $this->Form->control('longitude', ['id' => 'longitude']);
      echo '</div>';
    ?>

  </fieldset>
	<div id="map" style="width:400px !important; height:300px !important;"></div>
  <?= $this->Form->button(__('Submit')) ?>
  <?= $this->Form->end() ?>
</div>

 <script>
 var latElem=document.getElementById('latitude');
 var lngElem=document.getElementById('longitude');
      function initMap() {
        var myLatlng = {lat: 33.76320975109451, lng: 35.88419454007044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatlng
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
		  draggable:true,
          title: 'Click to zoom'
        });

        map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });

        marker.addListener('dragend', function() {
          console.log(marker.getPosition().lat());
          console.log(marker.getPosition().lng());
		  latElem.value=marker.getPosition().lat();
		  lngElem.value=marker.getPosition().lng();
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzJekCUDHhMNYKBCcIzV-4CGYZeualhvg&callback=initMap">
    </script>
