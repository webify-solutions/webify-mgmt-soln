 <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customer index large-9 medium-8 columns content">
    <h3><?= __('Customers') ?></h3>
    <table id='customer_table' cellpadding="0" cellspacing="0" class='display'>
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= __('Organization') ?></th>
                <?php endif; ?>
                <th scope="col"><?= __('Customer Number') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Group') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customer as $customer): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Customer', 'action' => 'edit', $customer->id]) ?>
                    <?= $this->Form->postLink(
                            __('Delete'),
                            [
                                'controller' => 'Customer',
                                'action' => 'delete',
                                $customer->id
                            ],
                            [
                                'confirm' => __('Are you sure you want to delete {0}?', $customer->name)
                            ]
                    ) ?>
                </td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $customer->has('organization') ? $this->Html->link($customer->organization->name, ['controller' => 'Organization', 'action' => 'view', $customer->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($customer->customer_number), ['controller' => 'Customer', 'action' => 'view', $customer->id]) ?></td>
                <td><?= h($customer->name) ?></td>
                <!-- <td><?= h($customer->title) ?></td> -->
                <td><?= $customer->has('group') ? $this->Html->link($customer->group->name, ['controller' => 'Group', 'action' => 'view', $customer->group->id]) : '' ?></td>
                <td><?= h($customer->phone) ?></td>
                <td><?= h($customer->active ? __('Yes') : __('No')) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->Html->script('Customer/index.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('datatables.min.js', ['block' => 'scriptBottom']) ?>
    <?php $this->Html->css('datatables.min.css', ['block' => 'cssBottom']) ?>
</div>
