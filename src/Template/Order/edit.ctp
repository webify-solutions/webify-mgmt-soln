<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Order'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoice'), ['controller' => 'Invoice', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoice', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payment'), ['controller' => 'Payment', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payment', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="order form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customer, 'empty' => true]);
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            echo $this->Form->control('order_number');
            echo $this->Form->control('description');
            echo $this->Form->control('effective_date', ['empty' => true]);
            echo $this->Form->control('type');
            echo $this->Form->control('total_amount');
            echo $this->Form->control('total_discount');
            echo $this->Form->control('active');
            echo $this->Form->control('created_at', ['empty' => true]);
            echo $this->Form->control('last_updated', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
