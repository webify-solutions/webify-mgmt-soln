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
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('order_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active', 'Cancelled') ?></th>
                <th scope="col" class="left-justified"><?= $this->Paginator->sort('subtotal_amount') ?></th>
                <th scope="col" class="left-justified"><?= $this->Paginator->sort('order_discount') ?></th>
                <th scope="col" class="left-justified"><?= $this->Paginator->sort('total_amount') ?></th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($order as $order): ?>
            <tr>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Order', 'action' => 'edit', $order->id]) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        [
                            'controller' => 'Order',
                            'action' => 'delete',
                            $order->id
                        ],
                        [
                            'confirm' => __('Are you sure you want to delete {0}?', $order->order_number)
                        ]
                    ) ?>
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
                </td>
                <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                    <td><?= $order->has('organization') ? $this->Html->link($order->organization->name, ['controller' => 'Organization', 'action' => 'view', $order->organization->id]) : '' ?></td>
                <?php endif; ?>
                <td><?= $this->Html->link(h($order->order_number), ['controller' => 'Order', 'action' => 'view', $order->id]) ?></td>
                <td><?= $order->has('customer') ?
                        $this->Html->link(
                            $order->customer->first_name . ' ' . $order->customer->last_name,
                            [
                                'controller' => 'Customer',
                                'action' => 'view',
                                $order->customer->id
                            ]
                        )
                        : ''
                ?></td>
                <td><?= h($order->order_date) ?></td>
                <td><?= h($order->active ? 'No' : 'Yes') ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->subtotal_amount) . ' ' . h($order->currency)) ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->order_discount) . '' . ($order->order_discount_unit == 'Percentage' ? '%' : ' ' . h($order->currency))) ?></td>
                <td class="left-justified"><?= __($this->Number->format($order->total_amount) . ' ' . h($order->currency)) ?></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
