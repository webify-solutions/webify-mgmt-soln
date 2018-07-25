<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceEntry $priceEntry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price Entry'), ['controller' => 'PriceEntry', 'action' => 'add', $priceEntry->product_id]) ?> </li>
        <li><?= $this->Html->link(__('Edit Price Entry'), ['controller' => 'PriceEntry', 'action' => 'edit', $priceEntry->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Price Entry'),
                [
                    'controller' => 'PriceEntry',
                    'action' => 'delete',
                    $priceEntry->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $priceEntry->price_entry_number)
                ])
        ?> </li>
    </ul>
</nav>
<div class="priceEntry view large-9 medium-8 columns content">
    <h3><?= __('Price Entry') ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Price Number') ?></th>
            <td><?= h($priceEntry->price_entry_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $priceEntry->has('product') ? $this->Html->link($priceEntry->product->name, ['controller' => 'Product', 'action' => 'view', $priceEntry->product->id]) : '' ?></td>
        </tr>
        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
            <tr>
                <th scope="row"><?= __('Organization') ?></th>
                <td><?= $priceEntry->has('organization') ? $this->Html->link($priceEntry->organization->name, ['controller' => 'Organization', 'action' => 'view', $priceEntry->organization->id]) : '' ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($priceEntry->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($priceEntry->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $priceEntry->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($priceEntry->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($priceEntry->last_updated) ?></td>
        </tr>

    </table>
</div>
