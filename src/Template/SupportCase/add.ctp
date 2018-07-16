<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupportCase $supportCase
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Support Case'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supportCase form large-9 medium-8 columns content">
    <?= $this->Form->create($supportCase) ?>
    <fieldset>
        <legend><?= __('Add Support Case') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customer, 'empty' => true]);
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            echo $this->Form->control('customer_number');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('type');
            echo $this->Form->control('subject');
            echo $this->Form->control('description');
            echo $this->Form->control('created_at', ['empty' => true]);
            echo $this->Form->control('last_updated', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
