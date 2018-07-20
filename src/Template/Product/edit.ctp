<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Products'), ['Controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete Product'),
                [
                    'controller' => 'Product',
                    'action' => 'delete',
                    $product->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $product->name)
                ]
            )
        ?></li>
    </ul>
</nav>
<div class="product form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('name');
            echo $this->Form->control('sku');
            echo $this->Form->control('description');
            echo $this->Form->control('type');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
