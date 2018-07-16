<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization[]|\Cake\Collection\CollectionInterface $organization
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="organization index large-9 medium-8 columns content">
    <h3><?= __('Organization') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active', 'Is Organization Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_product_feature','Is Product Feature Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_order_feature','Is Order Feature Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_invoicing_feature','Is Invoicing Feature Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_case_feature','Is Support Case Feature Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($organization as $organization): ?>
            <tr>
                <td>
                    <?= $this->Html->link(__(h($organization->name)), ['action' => 'view', $organization->id]) ?>
                </td>
                <td><?= h($organization->email) ?></td>
                <td><?= h($organization->phone) ?></td>
                <td><?= h($organization->address) ?></td>
                <td><?= h($organization->active ? __('Yes') : __('No')) ?></td>
                <td><?= h($organization->active_product_feature ? __('Yes') : __('No')) ?></td>
                <td><?= h($organization->active_order_feature ? __('Yes') : __('No')) ?></td>
                <td><?= h($organization->active_invoicing_feature ? __('Yes') : __('No')) ?></td>
                <td><?= h($organization->active_case_feature ? __('Yes') : __('No')) ?></td>
                <td><?= h($organization->created_at) ?></td>
                <td><?= h($organization->last_updated) ?></td>
                <td class="actions">

                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $organization->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $organization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id)]) ?>
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
