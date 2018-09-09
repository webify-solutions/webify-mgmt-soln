<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Group[]|\Cake\Collection\CollectionInterface $group
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller'=>'Group', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="group index large-9 medium-8 columns content">
    <h3><?= __('Groups') ?></h3>
    <table id='group_table' cellpadding="0" cellspacing="0" class='display'>
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= __('Organization') ?></th>
                <?php endif; ?>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($group as $group): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $group->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
                </td>
                <?php if(in_array('organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $group->has('organization') ? $this->Html->link($group->organization->name, ['controller' => 'Organization', 'action' => 'view', $group->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($group->name), ['action' => 'view', $group->id]) ?></td>
                <td><?= h($group->created_at) ?></td>
                <td><?= h($group->last_updated) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->Html->script('Group/index.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('datatables.min.js', ['block' => 'scriptBottom']) ?>
    <?php $this->Html->css('datatables.min.css', ['block' => 'cssBottom']) ?>
</div>
