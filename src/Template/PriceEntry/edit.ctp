<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceEntry $priceEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $priceEntry->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $priceEntry->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Price Entry'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceEntry form large-9 medium-8 columns content">
    <?= $this->Form->create($priceEntry) ?>
    <fieldset>
        <legend><?= __('Edit Price Entry') ?></legend>
        <?php
            echo $this->Form->control('product_id', ['options' => $product, 'empty' => true]);
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            echo $this->Form->control('price');
            echo $this->Form->control('available_discount');
            echo $this->Form->control('active');
            echo $this->Form->control('created_at', ['empty' => true]);
            echo $this->Form->control('last_updated', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
