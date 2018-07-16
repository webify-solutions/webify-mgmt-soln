<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem[]|\Cake\Collection\CollectionInterface $orderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order'), ['controller' => 'Order', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Entry'), ['controller' => 'PriceEntry', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Entry'), ['controller' => 'PriceEntry', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['controller' => 'InvoiceItem', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderItem index large-9 medium-8 columns content">
    <h3><?= __('Order Item') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_entry_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_discount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItem as $orderItem): ?>
            <tr>
                <td><?= $this->Number->format($orderItem->id) ?></td>
                <td><?= $orderItem->has('order') ? $this->Html->link($orderItem->order->id, ['controller' => 'Order', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
                <td><?= $orderItem->has('price_entry') ? $this->Html->link($orderItem->price_entry->id, ['controller' => 'PriceEntry', 'action' => 'view', $orderItem->price_entry->id]) : '' ?></td>
                <td><?= $orderItem->has('product') ? $this->Html->link($orderItem->product->name, ['controller' => 'Product', 'action' => 'view', $orderItem->product->id]) : '' ?></td>
                <td><?= $orderItem->has('organization') ? $this->Html->link($orderItem->organization->name, ['controller' => 'Organization', 'action' => 'view', $orderItem->organization->id]) : '' ?></td>
                <td><?= h($orderItem->order_item_number) ?></td>
                <td><?= $this->Number->format($orderItem->price_discount) ?></td>
                <td><?= h($orderItem->active) ?></td>
                <td><?= h($orderItem->created_at) ?></td>
                <td><?= h($orderItem->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
