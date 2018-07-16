<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Organizations'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="organization form large-9 medium-8 columns content">
    <?= $this->Form->create($organization) ?>
    <fieldset>
        <legend><?= __('Add Organization') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('address');
            echo $this->Form->control('active', ['label'=> 'Is Active']);

            echo '<legend>Activate Application features</legend>';
            echo '<br/>';
            echo $this->Form->control('active_product_feature', ['label'=> 'Products']);
            echo $this->Form->control('active_order_feature', ['label'=> 'Orders']);
            echo $this->Form->control('active_invoicing_feature', ['label'=> 'Invoicing']);
            echo $this->Form->control('active_case_feature', ['label'=> 'Support Cases']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
