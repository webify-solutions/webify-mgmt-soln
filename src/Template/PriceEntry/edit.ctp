<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceEntry $priceEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View Product'), ['controller' => 'Product', 'action' => 'view', $priceEntry->product_id]) ?></li>
        <li><?= $this->Html->link(__('New Price Entry'), ['controller' => 'PriceEntry', 'action' => 'add', $priceEntry->product_id]) ?> </li>
        <li><?= $this->Form->postLink(
            __('Delete Price Entry'),
            [
                'controller' => 'PriceEntry',
                'action' => 'delete',
                $priceEntry->id
            ],
            [
                'confirm' => __('Are you sure you want to delete # {0}?', $priceEntry->id)
            ])
        ?> </li>
    </ul>
</nav>
<div class="priceEntry form large-9 medium-8 columns content">
    <?= $this->Form->create($priceEntry) ?>
    <fieldset>
        <legend><?= __('Edit Price Entry') ?></legend>
        <?php
        if ($organization != null) {
            echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
        }
        echo $this->Form->control('product_id', ['options' => $product]);
        echo $this->Form->control('price');
        echo $this->Form->control('price_unit', ['options' => $currencies]);
        echo $this->Form->control('available_discount');
        echo $this->Form->control('available_discount_unit', ['options' => $discountUnits, 'empty' => true]);
        echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
