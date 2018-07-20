<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Group $group
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Groups'), ['controller' => 'Group', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller'=>'Group', 'action' => 'add']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete Group'),
                [
                    'controller' => 'Group',
                    'action' => 'delete', $group->id
                ],
                ['confirm' => __('Are you sure you want to delete {0}?', $group->name)]
            )
        ?></li>
    </ul>
</nav>
<div class="group form large-9 medium-8 columns content">
    <?= $this->Form->create($group) ?>
    <fieldset>
        <legend><?= __('Edit Group') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('name');
            //            echo $this->Form->control('user._ids', ['options' => $user]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
