<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Entry'), ['controller' => 'PriceEntry', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Entry'), ['controller' => 'PriceEntry', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="product view large-9 medium-8 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $product->has('organization') ? $this->Html->link($product->organization->name, ['controller' => 'Organization', 'action' => 'view', $product->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($product->sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($product->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($product->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($product->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $product->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoice Item') ?></h4>
        <?php if (!empty($product->invoice_item)): ?>
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
            <?php foreach ($product->invoice_item as $invoiceItem): ?>
            <tr>
                <td><?= h($invoiceItem->id) ?></td>
                <td><?= h($invoiceItem->invoice_id) ?></td>
                <td><?= h($invoiceItem->order_item_id) ?></td>
                <td><?= h($invoiceItem->product_id) ?></td>
                <td><?= h($invoiceItem->organization_id) ?></td>
                <td><?= h($invoiceItem->invoice_item_number) ?></td>
                <td><?= h($invoiceItem->total_price) ?></td>
                <td><?= h($invoiceItem->description) ?></td>
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
    <div class="related">
        <h4><?= __('Related Order Item') ?></h4>
        <?php if (!empty($product->order_item)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Price Entry Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Order Item Number') ?></th>
                <th scope="col"><?= __('Price Discount') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->order_item as $orderItem): ?>
            <tr>
                <td><?= h($orderItem->id) ?></td>
                <td><?= h($orderItem->order_id) ?></td>
                <td><?= h($orderItem->price_entry_id) ?></td>
                <td><?= h($orderItem->product_id) ?></td>
                <td><?= h($orderItem->organization_id) ?></td>
                <td><?= h($orderItem->order_item_number) ?></td>
                <td><?= h($orderItem->price_discount) ?></td>
                <td><?= h($orderItem->description) ?></td>
                <td><?= h($orderItem->active) ?></td>
                <td><?= h($orderItem->created_at) ?></td>
                <td><?= h($orderItem->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderItem', 'action' => 'view', $orderItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderItem', 'action' => 'edit', $orderItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderItem', 'action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Price Entry') ?></h4>
        <?php if (!empty($product->price_entry)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Available Discount') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->price_entry as $priceEntry): ?>
            <tr>
                <td><?= h($priceEntry->id) ?></td>
                <td><?= h($priceEntry->product_id) ?></td>
                <td><?= h($priceEntry->organization_id) ?></td>
                <td><?= h($priceEntry->price) ?></td>
                <td><?= h($priceEntry->available_discount) ?></td>
                <td><?= h($priceEntry->active) ?></td>
                <td><?= h($priceEntry->created_at) ?></td>
                <td><?= h($priceEntry->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PriceEntry', 'action' => 'view', $priceEntry->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PriceEntry', 'action' => 'edit', $priceEntry->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PriceEntry', 'action' => 'delete', $priceEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceEntry->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
