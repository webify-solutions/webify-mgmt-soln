<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Customer'),
                [
                    'controller' => 'Customer',
                    'action' => 'delete', $customer->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $customer->name)
                ]
            )
        ?> </li>
    </ul>
</nav>
<div class="customer form large-9 medium-8 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Edit Customer') ?></legend>
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
 console.log(latElem);
 var lngElem=document.getElementById('longitude');
 var latVal=parseFloat(latElem.value);
 console.log(latVal);
 var lngVal=parseFloat(lngElem.value) ;
   if(latElem.value=='' || latElem.value=='undefined' || latElem.value=="" || latElem.value=='undefined'){
	   latVal=33.762905;
	   lngVal=35.884231;
   }
      function initMap() {
        var myLatlng = {lat: latVal, lng:  lngVal};
        console.log(myLatlng)
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
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
