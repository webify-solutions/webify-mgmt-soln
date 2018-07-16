<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customer'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organization'), ['controller' => 'Organization', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organization', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice'), ['controller' => 'Invoice', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoice', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Item'), ['controller' => 'OrderItem', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Item'), ['controller' => 'OrderItem', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payment'), ['controller' => 'Payment', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payment', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="order view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $order->has('customer') ? $this->Html->link($order->customer->title, ['controller' => 'Customer', 'action' => 'view', $order->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $order->has('organization') ? $this->Html->link($order->organization->name, ['controller' => 'Organization', 'action' => 'view', $order->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Number') ?></th>
            <td><?= h($order->order_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($order->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= $this->Number->format($order->total_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Discount') ?></th>
            <td><?= $this->Number->format($order->total_discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Effective Date') ?></th>
            <td><?= h($order->effective_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($order->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($order->last_updated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $order->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($order->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoice') ?></h4>
        <?php if (!empty($order->invoice)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Invoice Number') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Total Price') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col"><?= __('Last Updated By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->invoice as $invoice): ?>
            <tr>
                <td><?= h($invoice->id) ?></td>
                <td><?= h($invoice->order_id) ?></td>
                <td><?= h($invoice->organization_id) ?></td>
                <td><?= h($invoice->invoice_number) ?></td>
                <td><?= h($invoice->start_date) ?></td>
                <td><?= h($invoice->end_date) ?></td>
                <td><?= h($invoice->total_price) ?></td>
                <td><?= h($invoice->description) ?></td>
                <td><?= h($invoice->created_at) ?></td>
                <td><?= h($invoice->last_updated) ?></td>
                <td><?= h($invoice->last_updated_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoice', 'action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoice', 'action' => 'edit', $invoice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoice', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Order Item') ?></h4>
        <?php if (!empty($order->order_item)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Price Entry Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Order Item Number') ?></th>
                <th scope="col"><?= __('Price Discount') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Last Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->order_item as $orderItem): ?>
            <tr>
                <td><?= h($orderItem->id) ?></td>
                <td><?= h($orderItem->order_id) ?></td>
                <td><?= h($orderItem->price_entry_id) ?></td>
                <td><?= h($orderItem->product_id) ?></td>
                <td><?= h($orderItem->organization_id) ?></td>
                <td><?= h($orderItem->order_item_number) ?></td>
                <td><?= h($orderItem->price_discount) ?></td>
                <td><?= h($orderItem->description) ?></td>
                <td><?= h($orderItem->active) ?></td>
                <td><?= h($orderItem->created_at) ?></td>
                <td><?= h($orderItem->last_updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderItem', 'action' => 'view', $orderItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderItem', 'action' => 'edit', $orderItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderItem', 'action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Payment') ?></h4>
        <?php if (!empty($order->payment)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Organization Id') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Void') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->payment as $payment): ?>
            <tr>
                <td><?= h($payment->id) ?></td>
                <td><?= h($payment->order_id) ?></td>
                <td><?= h($payment->organization_id) ?></td>
                <td><?= h($payment->total_amount) ?></td>
                <td><?= h($payment->transaction_date) ?></td>
                <td><?= h($payment->void) ?></td>
                <td><?= h($payment->created_at) ?></td>
                <td><?= h($payment->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payment', 'action' => 'view', $payment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payment', 'action' => 'edit', $payment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payment', 'action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
