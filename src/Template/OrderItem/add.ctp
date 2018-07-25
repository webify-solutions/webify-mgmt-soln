<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View Order'), ['controller' => 'Order', 'action' => 'view', $orderItem->order_id]) ?></li>
    </ul>
</nav>
<div class="orderItem form large-9 medium-8 columns content">
    <script>
        function updatePriceList(selectObject) {
            price_list_json = JSON.parse(document.getElementById('priceEntryJSON').value);
            price_json = price_list_json[selectObject.value];
            // alert(JSON.stringify(price_json));

            price_element = document.getElementById('unit-price');
            key = Object.keys(price_json);
            price_element.value = price_json[key];
            // while (priceSelectElement.length > 0) {
            //     // alert(priceSelectElement.length);
            //     priceSelectElement.remove(priceSelectElement.length - 1);
            // }
            //
            // option = document.createElement("option");
            // option.id = Object.keys(price_json);
            // option.value = price_json[option.id];
            // option.text = price_json[option.id];
            // option.selected = "selected";
            // priceSelectElement.add(option);
        }
    </script>
    <?= $this->Form->create($orderItem) ?>
    <fieldset>
        <legend><?= __('Add Order Item') ?></legend>
        <?php
            echo '<input id="priceEntryJSON" type="hidden" value=\'' . $priceEntryJSON . '\'>';
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('order_id', ['options' => $order, 'empty' => true]);
            echo $this->Form->control('product_id', ['options' => $product, 'empty' => true, 'onchange' => 'updatePriceList(this)']);
            echo $this->Form->control('unit_price', ['type'=>'text', 'readonly' => 'readonly', 'empty' => true]);
            echo $this->Form->control('unit_quantity');
//            echo $this->Form->control('price_discount');
//            echo $this->Form->control('price_discount_unit');
            echo $this->Form->control('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit & New')) ?>
    <?= $this->Form->end() ?>
</div>
