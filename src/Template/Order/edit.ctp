<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Orders'), ['controller' => 'Order', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete {0}?', $order->order_number)]
            )
        ?></li>
        <li><?= $this->Form->postLink(
                __('Cancel'),
                ['action' => 'cancel', $order->id],
                ['confirm' => __('Are you sure you want to Cancel {0}?', $order->order_number)]
            )
        ?></li>
    </ul>
</nav>
<div class="order form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('customer_id', ['options' => $customer, 'empty' => true]);
            echo $this->Form->control('order_date', ['empty' => true]);
            echo $this->Form->control('effective_date', ['empty' => true]);
            echo $this->Form->control('delivery_date', ['empty' => true]);
            echo $this->Form->control('type');
            echo $this->Form->control('notes');
            echo $this->Form->control('total_amount');
            echo $this->Form->control('total_discount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
