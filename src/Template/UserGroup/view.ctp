<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserGroup $userGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Group'), ['action' => 'edit', $userGroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Group'), ['action' => 'delete', $userGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userGroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Group'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Group'), ['controller' => 'Group', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Group', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userGroup view large-9 medium-8 columns content">
    <h3><?= h($userGroup->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $userGroup->has('organization') ? $this->Html->link($userGroup->organization->name, ['controller' => 'Organization', 'action' => 'view', $userGroup->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userGroup->has('user') ? $this->Html->link($userGroup->user->id, ['controller' => 'User', 'action' => 'view', $userGroup->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $userGroup->has('group') ? $this->Html->link($userGroup->group->name, ['controller' => 'Group', 'action' => 'view', $userGroup->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userGroup->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($userGroup->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($userGroup->last_updated) ?></td>
        </tr>
    </table>
</div>
