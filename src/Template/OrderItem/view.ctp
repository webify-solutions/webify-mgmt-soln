<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Item'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order'), ['controller' => 'Order', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Entry'), ['controller' => 'PriceEntry', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Entry'), ['controller' => 'PriceEntry', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderItem view large-9 medium-8 columns content">
    <h3><?= h($orderItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $orderItem->has('order') ? $this->Html->link($orderItem->order->id, ['controller' => 'Order', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Entry') ?></th>
            <td><?= $orderItem->has('price_entry') ? $this->Html->link($orderItem->price_entry->id, ['controller' => 'PriceEntry', 'action' => 'view', $orderItem->price_entry->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $orderItem->has('product') ? $this->Html->link($orderItem->product->name, ['controller' => 'Product', 'action' => 'view', $orderItem->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $orderItem->has('organization') ? $this->Html->link($orderItem->organization->name, ['controller' => 'Organization', 'action' => 'view', $orderItem->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Item Number') ?></th>
            <td><?= h($orderItem->order_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($orderItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Discount') ?></th>
            <td><?= $this->Number->format($orderItem->price_discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($orderItem->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($orderItem->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $orderItem->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($orderItem->notes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoice Item') ?></h4>
        <?php if (!empty($orderItem->invoice_item)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('Order Item Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Invoice Item Number') ?></th>
                <th scope="col"><?= __('Total Price') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col"><?= __('Last Updated By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($orderItem->invoice_item as $invoiceItem): ?>
            <tr>
                <td><?= h($invoiceItem->id) ?></td>
                <td><?= h($invoiceItem->invoice_id) ?></td>
                <td><?= h($invoiceItem->order_item_id) ?></td>
                <td><?= h($invoiceItem->product_id) ?></td>
                <td><?= h($invoiceItem->organization_id) ?></td>
                <td><?= h($invoiceItem->invoice_item_number) ?></td>
                <td><?= h($invoiceItem->total_price) ?></td>
                <td><?= h($invoiceItem->notes) ?></td>
                <td><?= h($invoiceItem->created_at) ?></td>
                <td><?= h($invoiceItem->last_updated) ?></td>
                <td><?= h($invoiceItem->last_updated_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InvoiceItem', 'action' => 'view', $invoiceItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InvoiceItem', 'action' => 'edit', $invoiceItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InvoiceItem', 'action' => 'delete', $invoiceItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
