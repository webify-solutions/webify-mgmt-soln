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
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add', $orderItem->order_id]) ?></li>
        <li><?= $this->Html->link(__('View Order Item'), ['controller' => 'OrderItem', 'action' => 'view', $orderItem->order_id]) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderItem->id],
                ['confirm' => __('Are you sure you want to delete {0}?', $orderItem->order_item_number)]
            )
        ?></li>
    </ul>
</nav>
<div class="orderItem form large-9 medium-8 columns content">
    <?= $this->Form->create($orderItem) ?>
    <fieldset>
        <legend><?= __('Edit Order Item') ?></legend>
        <?php
            echo $this->Form->control('order_item_number', ['disabled' => 'disabled']);
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('order_id', ['options' => $order, 'empty' => true, 'disabled' => 'disabled']);
            echo $this->Form->control(
              'product_id',
              [
                'options' => $productPickList,
                'empty' => true,
                'id' => 'product',
                'data-product-info-list' => $productInfoList,
                'data-product-related-info-list' => $productRelatedInfoList,
                'disabled' => 'disabled'
              ]
            );
            echo $this->Form->control('unit_price', ['type'=>'text', 'readonly' => 'readonly', 'empty' => true]);
            echo $this->Form->control('unit_quantity');
            echo $this->Form->control('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
