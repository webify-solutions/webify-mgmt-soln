<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Group'), ['controller' => 'Group', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Group', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order'), ['controller' => 'Order', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Support Case'), ['controller' => 'SupportCase', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Support Case'), ['controller' => 'SupportCase', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customer view large-9 medium-8 columns content">
    <h3><?= h($customer->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $customer->has('group') ? $this->Html->link($customer->group->name, ['controller' => 'Group', 'action' => 'view', $customer->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $customer->has('organization') ? $this->Html->link($customer->organization->name, ['controller' => 'Organization', 'action' => 'view', $customer->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($customer->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($customer->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($customer->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($customer->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($customer->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($customer->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($customer->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($customer->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($customer->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($customer->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $customer->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Order') ?></h4>
        <?php if (!empty($customer->order)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Order Number') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Effective Date') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Total Discount') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($customer->order as $order): ?>
            <tr>
                <td><?= h($order->id) ?></td>
                <td><?= h($order->customer_id) ?></td>
                <td><?= h($order->organization_id) ?></td>
                <td><?= h($order->order_number) ?></td>
                <td><?= h($order->description) ?></td>
                <td><?= h($order->effective_date) ?></td>
                <td><?= h($order->type) ?></td>
                <td><?= h($order->total_amount) ?></td>
                <td><?= h($order->total_discount) ?></td>
                <td><?= h($order->active) ?></td>
                <td><?= h($order->created_at) ?></td>
                <td><?= h($order->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Order', 'action' => 'view', $order->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Order', 'action' => 'edit', $order->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Order', 'action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Support Case') ?></h4>
        <?php if (!empty($customer->support_case)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Customer Number') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Subject') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($customer->support_case as $supportCase): ?>
            <tr>
                <td><?= h($supportCase->id) ?></td>
                <td><?= h($supportCase->customer_id) ?></td>
                <td><?= h($supportCase->organization_id) ?></td>
                <td><?= h($supportCase->customer_number) ?></td>
                <td><?= h($supportCase->first_name) ?></td>
                <td><?= h($supportCase->last_name) ?></td>
                <td><?= h($supportCase->email) ?></td>
                <td><?= h($supportCase->phone) ?></td>
                <td><?= h($supportCase->type) ?></td>
                <td><?= h($supportCase->subject) ?></td>
                <td><?= h($supportCase->description) ?></td>
                <td><?= h($supportCase->created_at) ?></td>
                <td><?= h($supportCase->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SupportCase', 'action' => 'view', $supportCase->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SupportCase', 'action' => 'edit', $supportCase->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SupportCase', 'action' => 'delete', $supportCase->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supportCase->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
