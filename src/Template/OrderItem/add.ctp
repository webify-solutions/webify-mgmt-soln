<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 * @var \App\Model\Entity\Organization $organization
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View Order'), ['controller' => 'Order', 'action' => 'view', $orderItem->order_id]) ?></li>
    </ul>
</nav>
<div class="orderItem form large-9 medium-8 columns content">
    <?= $this->Form->create($orderItem, ['id' => 'order-item-form']) ?>
    <fieldset>
        <legend><?= __('Add Order Item') ?></legend>
        <?php
            echo '<input id="do-continue" name="do_continue" type="hidden" value="true">';
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('order_id', ['options' => $order, 'empty' => true]);
            echo $this->Form->control('product_id', ['options' => $product, 'empty' => true, 'id' => 'product', 'data-custom-fields' => $productCustomFields]);
            echo $this->Form->control(
              'unit_price',
              [
                'id' => 'unit-price',
                'type'=>'text',
                'readonly' => 'readonly',
                'empty' => true,
                'data-price-list' =>  $priceEntryJSON
              ]
            );
            echo $this->Form->control('unit_quantity');

            for ($i = 1; $i <= 20; $i++) {
              echo '<div id="div-custom-field-' . $i . '" class="hidden">';
              echo $this->Form->control('custom_field_' . $i, ['id' => 'custom-field-' . $i]);
              echo '</div>';

            }
//            echo $this->Form->control('price_discount');
//            echo $this->Form->control('price_discount_unit');
            echo $this->Form->control('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit & Add New')) ?>
    <?= $this->Form->button(__('Submit & Done'), ['id' => 'submit-done']) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('OrderItem/add.js', ['block' => 'scriptBottom']); ?>
