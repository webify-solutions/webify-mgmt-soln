<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="product index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table id="product_table" cellpadding="0" cellspacing="0" class="display">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= __('Organization') ?></th>
                <?php endif; ?>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('SKU') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Create At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $product): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete {0}?', $product->name)]) ?>
                </td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $product->has('organization') ? $this->Html->link($product->organization->name, ['controller' => 'Organization', 'action' => 'view', $product->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($product->name), ['action' => 'view', $product->id]) ?></td>
                <td><?= h($product->sku) ?></td>
                <td><?= $product->has('product_category') ? h($product->product_category->name) : '' ?></td>
                <td><?= h($product->active ? __('Yes') : __('No')) ?></td>
                <td><?= h($product->created_at) ?></td>
                <td><?= h($product->last_updated) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->Html->script('Product/index.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('datatables.min.js', ['block' => 'scriptBottom']) ?>
    <?php $this->Html->css('datatables.min.css', ['block' => 'cssBottom']) ?>
</div>
