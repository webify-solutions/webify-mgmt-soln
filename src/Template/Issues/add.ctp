<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Issues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="issues form large-9 medium-8 columns content">
    <?= $this->Form->create($issue) ?>
    <fieldset>
        <legend><?= __('Add Issue') ?></legend>
        <?php
          if ($organization != null) {
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
          }
          echo $this->Form->control('subject', ['label' => 'Title']);
          echo $this->Form->control('customer_id', [
            'options' => $customers,
            'empty' => true,
            'data-customers-product-list' => $products,
            'id' => 'customers'
          ]);
          echo $this->Form->control('product_id', ['options' => [], 'empty' => true, 'id' => 'products']);
          echo $this->Form->control('technician_id', ['options' => $users, 'empty' => true, 'id' => 'technician']);
          echo $this->Form->control('status', ['options' => $statusPickList]);
          echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('Issues/add.js', ['block' => 'scriptBottom']); ?>
