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
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Edit Organization'), ['controller' => 'Organization', 'action' => 'edit', $organization->id]) ?> </li>
        <li>
            <?= $this->Form->postLink(__('Delete Organization'), ['controller' => 'Organization', 'action' => 'delete', $organization->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id)]) ?>
        </li>
    </ul>
</nav>
<div class="organization view large-9 medium-8 columns content">
    <h3><?= __('Organization') ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($organization->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($organization->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($organization->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($organization->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Organization Active') ?></th>
            <td><?= $organization->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Product Feature Active') ?></th>
            <td><?= $organization->active_product_feature ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Order Feature Active') ?></th>
            <td><?= $organization->active_order_feature ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Invoicing Feature Active') ?></th>
            <td><?= $organization->active_invoicing_feature ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Case Feature Active') ?></th>
            <td><?= $organization->active_case_feature ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($organization->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($organization->last_updated) ?></td>
        </tr>
    </table>
</div>
