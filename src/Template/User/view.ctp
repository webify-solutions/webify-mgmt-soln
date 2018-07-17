<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Edit User'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete User'),
                [
                    'controller' => 'User',
                    'action' => 'delete',
                    $user->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $user->id)
                ]
            )
         ?></li>

    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->login_name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $user->has('organization') ? $this->Html->link($user->organization->name, ['controller' => 'Organization', 'action' => 'view', $user->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Number') ?></th>
            <td><?= h($user->employee_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Name') ?></th>
            <td><?= h($user->login_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Start Date') ?></th>
            <td><?= h($user->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee End Date') ?></th>
            <td><?= h($user->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($user->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($user->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Logged In') ?></th>
            <td><?= h($user->last_logged_in) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Groups') ?></h4>
        <?php if (!empty($user->group)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
            </tr>
            <?php foreach ($user->group as $group): ?>
            <tr>
                <td><?= $this->Html->link(__(h($group->name)), ['controller' => 'Group', 'action' => 'view', $group->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
