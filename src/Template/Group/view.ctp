<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Group $group
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Groups'), ['controller' => 'Group', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Group', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Edit Group'), ['controller' => 'Group', 'action' => 'edit', $group->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Group'),
                [
                    'controller' => 'Group',
                    'action' => 'delete',
                    $group->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $group->name)])
        ?> </li>
    </ul>
</nav>
<div class="group view large-9 medium-8 columns content">
    <h3><?= h($group->name) ?></h3>
    <table class="vertical-table">
        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
            <tr>
                <th scope="row"><?= __('Organization') ?></th>
                <td><?= $group->has('organization') ? $this->Html->link($group->organization->name, ['controller' => 'Organization', 'action' => 'view', $group->organization->id]) : '' ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($group->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($group->last_updated) ?></td>
        </tr>
    </table>
    <?php if(in_array('User', $loggedUser['active_features'], true)) : ?>
        <div class="related">
            <h4><?= __('Related User') ?></h4>
            <?php if (!empty($group->user)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?=__('login_name') ?></th>
                    <th scope="col"><?=__('first_name') ?></th>
                    <th scope="col"><?=__('last_name') ?></th>
                    <?php if(in_array('organization', $loggedUser['active_features'], true)) : ?>
                        <th scope="col"><?=__('organization_id') ?></th>
                    <?php endif; ?>
                    <th scope="col"><?=__('phone') ?></th>
                    <th scope="col"><?=__('active', 'Is Active') ?></th>
                    <th scope="col"><?=__('last_logged_in') ?></th>
                </tr>
                <?php foreach ($group->user as $user): ?>
                <tr>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>
                    </td>
                    <td><?= $this->Html->link(__(h($user->login_name)), ['controller' => 'User', 'action' => 'view', $user->id]) ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <?php if(in_array('organization', $loggedUser['active_features'], true)) : ?>
                        <td><?= $user->has('organization') ? $this->Html->link($user->organization->name, ['controller' => 'Organization', 'action' => 'view', $user->organization->id]) : '' ?></td>
                    <?php endif; ?>
                    <td><?= h($user->phone) ?></td>
                    <td><?= h($user->active ? __('Yes') : __('No')) ?></td>
                    <td><?= h($user->last_logged_in) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if(in_array('Customer', $loggedUser['active_features'], true)) : ?>
        <div class="related">
            <h4><?= __('Related Customer') ?></h4>
            <?php if (!empty($group->customer)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <?php if(in_array('organization', $loggedUser['active_features'], true)) : ?>
                        <th scope="col"><?=__('organization_id') ?></th>
                    <?php endif; ?>
                    <th scope="col"><?=__('customer_number') ?></th>
                    <th scope="col"><?=__('title') ?></th>
                    <th scope="col"><?=__('first_name', 'Name') ?></th>
                    <th scope="col"><?=__('phone') ?></th>
                    <th scope="col"><?=__('active', 'Is Active') ?></th>
                </tr>
                <?php foreach ($group->customer as $customer): ?>
                <tr>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Customer', 'action' => 'edit', $customer->id]) ?>
                    </td>
                    <?php if(in_array('organization', $loggedUser['active_features'], true)) : ?>
                        <td><?= $customer->has('organization') ? $this->Html->link($customer->organization->name, ['controller' => 'Organization', 'action' => 'view', $customer->organization->id]) : '' ?></td>
                    <?php endif; ?>
                    <td><?= $this->Html->link(h($customer->customer_number), ['controller' => 'Customer', 'action' => 'view', $customer->id]) ?></td>
                    <td><?= h($customer->title) ?></td>
                    <td><?= h(__('{0} {1}', $customer->first_name, $customer->last_name)) ?></td>
                    <td><?= h($customer->phone) ?></td>
                    <td><?= h($customer->active ? __('Yes') : __('No')) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
