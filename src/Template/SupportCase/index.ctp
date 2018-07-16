<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupportCase[]|\Cake\Collection\CollectionInterface $supportCase
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Support Case'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supportCase index large-9 medium-8 columns content">
    <h3><?= __('Support Case') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supportCase as $supportCase): ?>
            <tr>
                <td><?= $this->Number->format($supportCase->id) ?></td>
                <td><?= $supportCase->has('customer') ? $this->Html->link($supportCase->customer->title, ['controller' => 'Customer', 'action' => 'view', $supportCase->customer->id]) : '' ?></td>
                <td><?= $supportCase->has('organization') ? $this->Html->link($supportCase->organization->name, ['controller' => 'Organization', 'action' => 'view', $supportCase->organization->id]) : '' ?></td>
                <td><?= h($supportCase->customer_number) ?></td>
                <td><?= h($supportCase->first_name) ?></td>
                <td><?= h($supportCase->last_name) ?></td>
                <td><?= h($supportCase->email) ?></td>
                <td><?= h($supportCase->phone) ?></td>
                <td><?= h($supportCase->type) ?></td>
                <td><?= h($supportCase->subject) ?></td>
                <td><?= h($supportCase->created_at) ?></td>
                <td><?= h($supportCase->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $supportCase->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supportCase->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supportCase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supportCase->id)]) ?>
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
