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
            price_list_json_string = '<?php echo $priceEntryJSON ?>';
            // (price_list_json_string);
            price_list_json = JSON.parse(price_list_json_string);
            // alert(JSON.stringify(price_list_json));
            price_json = price_list_json[selectObject.value];
            // alert(JSON.stringify(price_json));

            price_element = document.getElementById('unit-price');
            key = Object.keys(price_json);
            price_element.value = price_json[key];
        }

        function do_not_continue() {
           document.getElementById("do-continue").value = "false";
           // alert(document.getElementById("do-continue").value)
        }
    </script>
    <?= $this->Form->create($orderItem, ['id' => 'order-item-form']) ?>
    <fieldset>
        <legend><?= __('Add Order Item') ?></legend>
        <?php
            echo '<input id="do-continue" name="do-continue" type="hidden" value="true">';
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
    <?= $this->Form->button(__('Submit & Add New')) ?>
    <?= $this->Form->button(__('Submit & Done'), ['onclick' => 'do_not_continue()']) ?>
    <?= $this->Form->end() ?>
</div>
