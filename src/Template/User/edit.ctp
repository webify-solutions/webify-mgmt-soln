<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
        <li>
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
        </li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            echo $this->Form->control('employee_number');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('login_name');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control(
                'start_date',
                [
                    'label' => 'Employee Start Date',
                    'empty' => true,
                    'minYear' => date( 'Y') - 40,
                    'maxYear' => date('Y')
                ]
            );
            echo $this->Form->control(
                'end_date',
                [
                    'label' => 'Employee End Date',
                    'empty' => true,
                    'minYear' => date( 'Y') - 40,
                    'maxYear' => date('Y')
                ]
            );
            echo $this->Form->control('role', ['options' => $userRoles]);
            echo $this->Form->control('active', ['label' => 'Is Active']);
            echo $this->Form->control('group._ids', ['options' => $group]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
