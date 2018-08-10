<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View Order'), ['controller' => 'Order', 'action' => 'view', $orderItem->order_id]) ?></li>
        <li><?= $this->Html->link(__('New Order Item'), ['action' => 'add', $orderItem->order_id]) ?> </li>
        <li><?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete {0}?', $orderItem->order_item_number)]) ?> </li>
    </ul>
</nav>
<div class="orderItem view large-9 medium-8 columns content">
    <h3><?= __('Order Item') ?></h3>
    <table class="vertical-table">

        <tr>
            <th scope="row"><?= __('Order Item Number') ?></th>
            <td><?= h($orderItem->order_item_number) ?></td>
        </tr>
        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
            <tr>
                <th scope="row"><?= __('Organization') ?></th>
                <td><?= $orderItem->has('organization') ? $this->Html->link($orderItem->organization->name, ['controller' => 'Organization', 'action' => 'view', $orderItem->organization->id]) : '' ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $orderItem->has('product') ? $this->Html->link($orderItem->product->name, ['controller' => 'Product', 'action' => 'view', $orderItem->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Price') ?></th>
            <td><?= $this->Number->format($orderItem->unit_price) . ' ' . h($orderItem->order->currency)?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Quantity') ?></th>
            <td><?= $this->Number->format($orderItem->unit_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Price') ?></th>
            <td><?= $this->Number->format($orderItem->total) . ' ' . h($orderItem->order->currency)?></td>
        </tr>
        <?php
          $customFieldLabels = json_decode($productCustomFieldLabels, true)[$orderItem->product_id];
          for ($i = 1; $i <= 20; $i++) {
            $customFieldLabel = $customFieldLabels['custom_field_' . $i];
            if($customFieldLabel != null) {
              // echo $customFieldLabel;
              echo '<tr>';
              echo '  <th scope="row">' . h($customFieldLabel) . '*</th>';
              echo '  <td>' . h($orderItem->get('custom_field_' . $i)). '</td>';
              echo '</tr>';
            }
          }
        ?>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($orderItem->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($orderItem->last_updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($orderItem->notes)); ?>
    </div>
    <?php if(in_array('Invoice', $loggedUser['active_features'], true)) : ?>
        <div class="related">
            <h4><?= __('Related Invoice Item') ?></h4>
            <?php if (!empty($orderItem->invoice_item)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Invoice Id') ?></th>
                    <th scope="col"><?= __('Order Item Id') ?></th>
                    <th scope="col"><?= __('Product Id') ?></th>
                    <th scope="col"><?= __('Organization Id') ?></th>
                    <th scope="col"><?= __('Invoice Item Number') ?></th>
                    <th scope="col"><?= __('Total Price') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Created At') ?></th>
                    <th scope="col"><?= __('Last Updated') ?></th>
                    <th scope="col"><?= __('Last Updated By') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($orderItem->invoice_item as $invoiceItem): ?>
                <tr>
                    <td><?= h($invoiceItem->id) ?></td>
                    <td><?= h($invoiceItem->invoice_id) ?></td>
                    <td><?= h($invoiceItem->order_item_id) ?></td>
                    <td><?= h($invoiceItem->product_id) ?></td>
                    <td><?= h($invoiceItem->organization_id) ?></td>
                    <td><?= h($invoiceItem->invoice_item_number) ?></td>
                    <td><?= h($invoiceItem->total_price) ?></td>
                    <td><?= h($invoiceItem->notes) ?></td>
                    <td><?= h($invoiceItem->created_at) ?></td>
                    <td><?= h($invoiceItem->last_updated) ?></td>
                    <td><?= h($invoiceItem->last_updated_by) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'InvoiceItem', 'action' => 'view', $invoiceItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'InvoiceItem', 'action' => 'edit', $invoiceItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'InvoiceItem', 'action' => 'delete', $invoiceItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
