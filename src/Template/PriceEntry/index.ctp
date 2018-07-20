<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceEntry[]|\Cake\Collection\CollectionInterface $priceEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price Entry'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceEntry index large-9 medium-8 columns content">
    <h3><?= __('Price Entries') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('available_discount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($priceEntry as $priceEntry): ?>
            <tr>
                <td><?= $this->Number->format($priceEntry->id) ?></td>
                <td><?= $priceEntry->has('product') ? $this->Html->link($priceEntry->product->name, ['controller' => 'Product', 'action' => 'view', $priceEntry->product->id]) : '' ?></td>
                <td><?= $priceEntry->has('organization') ? $this->Html->link($priceEntry->organization->name, ['controller' => 'Organization', 'action' => 'view', $priceEntry->organization->id]) : '' ?></td>
                <td><?= $this->Number->format($priceEntry->price) ?></td>
                <td><?= h($priceEntry->available_discount) ?></td>
                <td><?= h($priceEntry->active) ?></td>
                <td><?= h($priceEntry->created_at) ?></td>
                <td><?= h($priceEntry->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $priceEntry->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceEntry->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priceEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceEntry->id)]) ?>
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
