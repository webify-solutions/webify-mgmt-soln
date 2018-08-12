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
    </ul>
</nav>
<div class="priceEntry form large-9 medium-8 columns content">
    <?= $this->Form->create($priceEntry) ?>
    <fieldset>
        <legend><?= __('Add Price Entry') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('product_id', ['options' => $product]);
            echo $this->Form->control('price', ['label' => 'Price ' . $loggedUser['organization_default_currency']]);
            echo '<div class="hidden">' . $this->Form->control('currencies', ['options' => $currencies]) . '</div>';
//            echo $this->Form->control('available_discount');
//            echo $this->Form->control('available_discount_unit', ['options' => $discountUnits, 'empty' => true]);
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
