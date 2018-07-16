<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceEntry $priceEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price Entry'), ['action' => 'edit', $priceEntry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price Entry'), ['action' => 'delete', $priceEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceEntry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Price Entry'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Entry'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="priceEntry view large-9 medium-8 columns content">
    <h3><?= h($priceEntry->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $priceEntry->has('product') ? $this->Html->link($priceEntry->product->name, ['controller' => 'Product', 'action' => 'view', $priceEntry->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $priceEntry->has('organization') ? $this->Html->link($priceEntry->organization->name, ['controller' => 'Organization', 'action' => 'view', $priceEntry->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Discount') ?></th>
            <td><?= h($priceEntry->available_discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($priceEntry->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($priceEntry->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($priceEntry->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($priceEntry->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $priceEntry->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Order Item') ?></h4>
        <?php if (!empty($priceEntry->order_item)): ?>
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
            <?php foreach ($priceEntry->order_item as $orderItem): ?>
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
</div>
