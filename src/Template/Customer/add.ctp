<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Customers'), ['collector' => 'Customer', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customer form large-9 medium-8 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('name');
            // echo $this->Form->control('title');
            echo $this->Form->control('phone');
            echo $this->Form->control('active');
            echo $this->Form->control('group_id', ['options' => $group, 'empty' => true]);
            echo $this->Form->control('email', ['type' => 'email']);
            echo $this->Form->control('address');
            echo $this->Form->control('longitude');
            echo $this->Form->control('latitude');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
