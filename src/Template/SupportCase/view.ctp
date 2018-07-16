<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupportCase $supportCase
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Support Case'), ['action' => 'edit', $supportCase->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Support Case'), ['action' => 'delete', $supportCase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supportCase->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Support Case'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Support Case'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="supportCase view large-9 medium-8 columns content">
    <h3><?= h($supportCase->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $supportCase->has('customer') ? $this->Html->link($supportCase->customer->title, ['controller' => 'Customer', 'action' => 'view', $supportCase->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $supportCase->has('organization') ? $this->Html->link($supportCase->organization->name, ['controller' => 'Organization', 'action' => 'view', $supportCase->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Number') ?></th>
            <td><?= h($supportCase->customer_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($supportCase->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($supportCase->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($supportCase->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($supportCase->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($supportCase->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($supportCase->subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($supportCase->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($supportCase->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($supportCase->last_updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($supportCase->description)); ?>
    </div>
</div>
