<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="user index large-9 medium-8 columns content">
    <h3><?= __('User') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <th scope="col"><?= $this->Paginator->sort('login_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active', 'Is Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_logged_in') ?></th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $user): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(
                            __('Delete'),
                            [
                                'controller' => 'User',
                                'action' => 'delete', $user->id
                            ],
                            [
                                'confirm' => __('Are you sure you want to delete {0}?', $user->login_name)
                            ]
                    ) ?>
                </td>
                <td><?= $this->Html->link(__(h($user->login_name)), ['controller' => 'User', 'action' => 'view', $user->id]) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $user->has('organization') ? $this->Html->link($user->organization->name, ['controller' => 'Organization', 'action' => 'view', $user->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->active ? __('Yes') : __('No')) ?></td>
                <td><?= h($user->last_logged_in) ?></td>
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
