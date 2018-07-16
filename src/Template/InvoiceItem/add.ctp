<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceItem $invoiceItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Invoice Item'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Invoice'), ['controller' => 'Invoice', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoice', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceItem form large-9 medium-8 columns content">
    <?= $this->Form->create($invoiceItem) ?>
    <fieldset>
        <legend><?= __('Add Invoice Item') ?></legend>
        <?php
            echo $this->Form->control('invoice_id', ['options' => $invoice, 'empty' => true]);
            echo $this->Form->control('order_item_id', ['options' => $orderItem, 'empty' => true]);
            echo $this->Form->control('product_id', ['options' => $product, 'empty' => true]);
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            echo $this->Form->control('invoice_item_number');
            echo $this->Form->control('total_price');
            echo $this->Form->control('description');
            echo $this->Form->control('created_at', ['empty' => true]);
            echo $this->Form->control('last_updated', ['empty' => true]);
            echo $this->Form->control('last_updated_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
