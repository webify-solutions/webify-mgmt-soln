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
        <li><?= $this->Html->link(__('Edit Product'), ['controller' => 'Product', 'action' => 'edit', $product->id]) ?> </li>
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
<div class="product view large-9 medium-8 columns content">
    <h3><?= __('Product') ?></h3>
    <table class="vertical-table">
        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
            <tr>
                <th scope="row"><?= __('Organization') ?></th>
                <td><?= $product->has('organization') ? $this->Html->link($product->organization->name, ['controller' => 'Organization', 'action' => 'view', $product->organization->id]) : '' ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($product->sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('product_category') ? h($product->product_category->name) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= h($product->active ? __('Yes') : __('No')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($product->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($product->last_updated) ?></td>
        </tr>

    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>

    <div class="row">
        <h4><?= __('Extra Fields') ?></h4>
        <?php
          $productCustomFieldLabels = json_decode($productCustomFieldLabels, true);
          if(key_exists($product->id, $productCustomFieldLabels)) {
            $customFieldLabels = $productCustomFieldLabels[$product->id];
            for ($i = 1; $i <= 20; $i++) {
              $customFieldLabel = $customFieldLabels['custom_field_' . $i];
              if($customFieldLabel != null) {
                // echo $customFieldLabel;
                echo '<span style="display: block">' . h($customFieldLabel). '</span>';
              }
            }
          }
        ?>
    </div>


    <div class="related">
        <h4><?= __('Related Price Entry ({0})', $this->Html->link(__('Add New'), ['controller' => 'PriceEntry', 'action' => 'add', $product->id]))  ?></h4>
        <?php if (!empty($product->price_entry)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                        <th scope="col"><?= __('Organization Id') ?></th>
                    <?php endif; ?>
                    <th scope="col"><?= __('Price Number')?></th>
                    <th scope="col"><?= __('Price') ?></th>
                    <th scope="col"><?= __('Currency') ?></th>
                    <th scope="col"><?= __('Active') ?></th>
                    <th scope="col"><?= __('Created At') ?></th>
                    <th scope="col"><?= __('Last Updated') ?></th>
                </tr>
                <?php foreach ($product->price_entry as $priceEntry): ?>
                    <tr>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'PriceEntry', 'action' => 'edit', $priceEntry->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'PriceEntry', 'action' => 'delete', $priceEntry->id], ['confirm' => __('Are you sure you want to delete {0}?', $priceEntry->price_entry_number)]) ?>
                        </td>
                        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                            <td><?= h($priceEntry->organization_id) ?></td>
                        <?php endif; ?>
                        <td><?= $this->Html->link(h($priceEntry->price_entry_number), ['controller' => 'PriceEntry', 'action' => 'view', $priceEntry->id]) ?></td>
                        <td><?= h($priceEntry->price) ?></td>
                        <td><?= h($priceEntry->currency) ?></td>
                        <td><?= h($priceEntry->active ? __('Yes') : __('No')) ?></td>
                        <td><?= h($priceEntry->created_at) ?></td>
                        <td><?= h($priceEntry->last_updated) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
