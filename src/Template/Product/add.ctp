<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \App\Model\Entity\ProductCategory[] $categories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Products'), ['Controller' => 'Product', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="product form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            } else if (isset($loggedUser) and isset($loggedUser['organization_id'])) {
                echo '<div class="hidden">';
                echo $this->Form->control('organization_id', ['type' => 'text']);
                echo '</div>';
            }
            echo $this->Form->control('name');
            echo $this->Form->control('sku');
            echo $this->Form->control('description');
            echo $this->Form->control('category_id', ['id' => 'category-id', 'options' => $categories, 'empty' => true]);
            echo $this->Form->control('category_name', ['id' => 'category-name']);
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('Product/add.js', ['block' => 'scriptBottom']); ?>
