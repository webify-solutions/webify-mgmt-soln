<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceItem[]|\Cake\Collection\CollectionInterface $invoiceItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['action' => 'add']) ?></li>
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
<div class="invoiceItem index large-9 medium-8 columns content">
    <h3><?= __('Invoice Item') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoiceItem as $invoiceItem): ?>
            <tr>
                <td><?= $this->Number->format($invoiceItem->id) ?></td>
                <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoice', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
                <td><?= $invoiceItem->has('order_item') ? $this->Html->link($invoiceItem->order_item->id, ['controller' => 'OrderItem', 'action' => 'view', $invoiceItem->order_item->id]) : '' ?></td>
                <td><?= $invoiceItem->has('product') ? $this->Html->link($invoiceItem->product->name, ['controller' => 'Product', 'action' => 'view', $invoiceItem->product->id]) : '' ?></td>
                <td><?= $invoiceItem->has('organization') ? $this->Html->link($invoiceItem->organization->name, ['controller' => 'Organization', 'action' => 'view', $invoiceItem->organization->id]) : '' ?></td>
                <td><?= h($invoiceItem->invoice_item_number) ?></td>
                <td><?= $this->Number->format($invoiceItem->total_price) ?></td>
                <td><?= h($invoiceItem->created_at) ?></td>
                <td><?= h($invoiceItem->last_updated) ?></td>
                <td><?= $this->Number->format($invoiceItem->last_updated_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoiceItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoiceItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoiceItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItem->id)]) ?>
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
