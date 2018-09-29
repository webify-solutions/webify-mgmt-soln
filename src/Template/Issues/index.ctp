<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue[]|\Cake\Collection\CollectionInterface $issues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Issue'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="issues index large-9 medium-8 columns content">
    <h3><?= __('Issues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('technician_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issues as $issue): ?>
            <tr>
                <td><?= $this->Number->format($issue->id) ?></td>
                <td><?= $issue->has('organization') ? $this->Html->link($issue->organization->name, ['controller' => 'Organization', 'action' => 'view', $issue->organization->id]) : '' ?></td>
                <td><?= $issue->has('customer') ? $this->Html->link($issue->customer->name, ['controller' => 'Customer', 'action' => 'view', $issue->customer->id]) : '' ?></td>
                <td><?= $issue->has('user') ? $this->Html->link($issue->user->id, ['controller' => 'User', 'action' => 'view', $issue->user->id]) : '' ?></td>
                <td><?= $issue->has('product') ? $this->Html->link($issue->product->name, ['controller' => 'Product', 'action' => 'view', $issue->product->id]) : '' ?></td>
                <td><?= h($issue->status) ?></td>
                <td><?= h($issue->type) ?></td>
                <td><?= h($issue->subject) ?></td>
                <td><?= h($issue->created_at) ?></td>
                <td><?= h($issue->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $issue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $issue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $issue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issue->id)]) ?>
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
