<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceItem $invoiceItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice Item'), ['action' => 'edit', $invoiceItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice Item'), ['action' => 'delete', $invoiceItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Item'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice'), ['controller' => 'Invoice', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoice', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoiceItem view large-9 medium-8 columns content">
    <h3><?= h($invoiceItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Invoice') ?></th>
            <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoice', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Item') ?></th>
            <td><?= $invoiceItem->has('order_item') ? $this->Html->link($invoiceItem->order_item->id, ['controller' => 'OrderItem', 'action' => 'view', $invoiceItem->order_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $invoiceItem->has('product') ? $this->Html->link($invoiceItem->product->name, ['controller' => 'Product', 'action' => 'view', $invoiceItem->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $invoiceItem->has('organization') ? $this->Html->link($invoiceItem->organization->name, ['controller' => 'Organization', 'action' => 'view', $invoiceItem->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Item Number') ?></th>
            <td><?= h($invoiceItem->invoice_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Price') ?></th>
            <td><?= $this->Number->format($invoiceItem->total_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated By') ?></th>
            <td><?= $this->Number->format($invoiceItem->last_updated_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($invoiceItem->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($invoiceItem->last_updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceItem->description)); ?>
    </div>
</div>
