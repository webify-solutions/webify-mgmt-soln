<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Customer'),
                [
                    'controller' => 'Customer',
                    'action' => 'delete', $customer->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $customer->name)
                ]
            )
        ?> </li>
    </ul>
</nav>
<div class="customer form large-9 medium-8 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Edit Customer') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('name');
            // echo $this->Form->control('title');
            echo $this->Form->control('phone');
            echo $this->Form->control('active');
            echo $this->Form->control('group_id', ['options' => $group, 'empty' => true]);
            echo $this->Form->control('email');
            echo $this->Form->control('address');
            echo $this->Form->control('longitude');
            echo $this->Form->control('latitude');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
