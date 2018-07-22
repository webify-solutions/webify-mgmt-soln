<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="order index large-9 medium-8 columns content">
    <h3><?= __('Order') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('order_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_discount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active', 'Cancelled') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order as $order): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
                </td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $order->has('organization') ? $this->Html->link($order->organization->name, ['controller' => 'Organization', 'action' => 'view', $order->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($order->order_number), ['action' => 'view', $order->id]) ?></td>
                <td><?= $order->has('customer') ? $this->Html->link($order->customer->title, ['controller' => 'Customer', 'action' => 'view', $order->customer->id]) : '' ?></td>
                <td><?= h($order->order_date) ?></td>
                <td><?= $this->Number->format($order->total_amount) ?></td>
                <td><?= $this->Number->format($order->total_discount) ?></td>
                <td><?= h($order->active ? 'No' : 'Yes') ?></td>
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
