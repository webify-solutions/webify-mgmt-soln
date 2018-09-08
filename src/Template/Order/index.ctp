<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Order', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="order index large-9 medium-8 columns content">
    <h3><?= __('Orders') ?></h3>
    <table id="order_table" cellpadding="0" cellspacing="0" class="display">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= __('Organization') ?></th>
                <?php endif; ?>
                <th scope="col"><?= __('Order Number') ?></th>
                <th scope="col"><?= __('Customer') ?></th>
                <th scope="col"><?= __('Order Date') ?></th>
                <th scope="col" class="left-justified"><?= __('Subtotal Amount') ?></th>
                <th scope="col" class="left-justified"><?= __('Order Discount') ?></th>
                <th scope="col" class="left-justified"><?= __('Total Amount') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order as $order): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Order', 'action' => 'edit', $order->id]) ?>
                    <?php if ($order->active) : ?>
                      <?= $this->Form->postLink(
                          __('Cancel'),
                          [
                              'controller' => 'Order',
                              'action' => 'cancel',
                              $order->id
                          ],
                          [
                              'confirm' => __('Are you sure you want to cancel {0}?', $order->order_number)
                          ]
                      ) ?>
                    <?php endif; ?>
                    <?= $this->Form->postLink(
                        __('Del'),
                        [
                            'controller' => 'Order',
                            'action' => 'delete',
                            $order->id
                        ],
                        [
                            'confirm' => __('Are you sure you want to delete {0}?', $order->order_number)
                        ]
                    ) ?>
                </td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $order->has('organization') ? $this->Html->link($order->organization->name, ['controller' => 'Organization', 'action' => 'view', $order->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($order->order_number), ['controller' => 'Order', 'action' => 'view', $order->id]) ?></td>
                <td><?= $order->has('customer') ?
                        $this->Html->link(
                            $order->customer->name,
                            [
                                'controller' => 'Customer',
                                'action' => 'view',
                                $order->customer->id
                            ]
                        )
                        : ''
                ?></td>
                <td><?= h($order->order_date) ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->subtotal_amount) . ' ' . h($order->currency)) ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->order_discount) . '' . ($order->order_discount_unit == 'Percentage' ? '%' : ' ' . h($order->currency))) ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->total_amount) . ' ' . h($order->currency)) ?></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->Html->script('order/index.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('datatables.min.js', ['block' => 'scriptBottom']) ?>
    <?php $this->Html->css('datatables.min.css', ['block' => 'cssBottom']) ?>
</div>
