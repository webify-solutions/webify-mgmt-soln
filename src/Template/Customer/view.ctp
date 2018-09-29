<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customer', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Edit Customer'), ['controller' => 'Customer', 'action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete Customer'),
                [
                    'controller' => 'Customer',
                    'action' => 'delete', $customer->id
                ],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $customer->name)
                ]
            )
         ?> </li>
    </ul>
</nav>
<div class="customer view large-9 medium-8 columns content">
    <h3><?= __('Customer') ?></h3>
    <table class="vertical-table">
        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
            <tr>
                <th scope="row"><?= __('Organization') ?></th>
                <td><?= $customer->has('organization') ? $this->Html->link($customer->organization->name, ['controller' => 'Organization', 'action' => 'view', $customer->organization->id]) : '' ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Customer Number') ?></th>
            <td><?= h($customer->customer_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($customer->name) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($customer->title) ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $customer->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $customer->has('group') ? $this->Html->link($customer->group->name, ['controller' => 'Group', 'action' => 'view', $customer->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($customer->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($customer->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($customer->address) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($customer->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($customer->latitude) ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($customer->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Updated') ?></th>
            <td><?= h($customer->last_updated) ?></td>
        </tr>
    </table>
    <?php if(in_array('Order', $loggedUser['active_features'], true)) : ?>
        <div class="related">
            <h4><?= 'Related Order ' . $this->Html->link(
              'Add New',
              [
                'controller' => 'Order',
                'action' => 'add',
                $customer->id,
                '?' => ['auto' => 1]
              ],
              array(
                'class' => 'button success'
              )
            ) ?></h4>
            <?php if (!empty($orders)): ?>
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                            <th scope="col"><?= $this->Paginator->sort('organization_id') ?></th>
                        <?php endif; ?>
                        <th scope="col"><?= $this->Paginator->sort('order_number') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('active', 'Cancelled') ?></th>
                        <th scope="col" class="left-justified"><?= $this->Paginator->sort('subtotal_amount', 'Subtotal') ?></th>
                        <th scope="col" class="left-justified"><?= $this->Paginator->sort('order_discount', 'Discount') ?></th>
                        <th scope="col" class="left-justified"><?= $this->Paginator->sort('total_amount', 'Total') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                            <td><?= $order->has('organization') ? $this->Html->link($order->organization->name, ['controller' => 'Organization', 'action' => 'view', $order->organization->id]) : '' ?></td>
                        <?php endif; ?>
                        <td><?= $this->Html->link(h($order->order_number), ['controller' => 'Order', 'action' => 'view', $order->id]) ?></td>
                        <td><?= h($order->order_date) ?></td>
                        <td><?= h($order->active ? 'No' : 'Yes') ?></td>
                        <td class="left-justified"><?= __($this->Number->format($order->subtotal_amount) . ' ' . h($order->currency)) ?></td>
                        <td class="left-justified"><?= __($this->Number->format($order->order_discount) . '' . ($order->order_discount_unit == 'Percentage' ? '%' : ' ' . h($order->currency))) ?></td>
                        <td class="left-justified"><?= __($this->Number->format($order->total_amount) . ' ' . h($order->currency)) ?></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
  <?php if(in_array('Issues', $loggedUser['active_features'], true)) : ?>
    <div class="related">
      <h4><?= 'Related Issues ' . $this->Html->link(
        'Add New',
        [
          'controller' => 'Issues',
          'action' => 'add',
          $customer->id
        ],
        array(
          'class' => 'button success'
        )
      ) ?></h4>
      <?php if (!empty($issues)): ?>
        <table cellpadding="0" cellspacing="0">
          <tr>
              <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                  <th scope="col"><?= __('Organization') ?></th>
              <?php endif; ?>
              <th scope="col"><?= __('Issue Number') ?></th>
              <th scope="col"><?= __('Product') ?></th>
              <th scope="col"><?= __('Customer') ?></th>
              <th scope="col"><?= __('Technician') ?></th>
              <th scope="col"><?= __('Status') ?></th>
              <th scope="col"><?= __('Description') ?></th>
              <th scope="col"><?= __('Last Updated') ?></th>
          </tr>
          <?php foreach ($issues as $issue): ?>
            <tr>
              <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                <td><?= $issue->has('organization') ? $this->Html->link($issue->organization->name, ['controller' => 'Organization', 'action' => 'view', $issue->organization->id]) : '' ?></td>
              <?php endif; ?>
              <td><?= $this->Html->link(h($issue->issue_number), ['controller' => 'Issues', 'action' => 'view', $issue->id]) ?></td>
              <td><?= $issue->has('product') ? $this->Html->link($issue->product->name, ['controller' => 'Product', 'action' => 'view', $issue->product->id]) : '' ?></td>
              <td><?= $issue->has('customer') ? $this->Html->link($issue->customer->name, ['controller' => 'Customer', 'action' => 'view', $issue->customer->id]) : '' ?></td>
              <td><?= $issue->has('user') ? $this->Html->link($issue->user->name, ['controller' => 'User', 'action' => 'view', $issue->user->id]) : '' ?></td>
              <td><?= h($issue->status) ?></td>
              <td><?= h($issue->description) ?></td>
              <td><?= h($issue->last_updated) ?></td>
            </tr>
          <?php endforeach; ?>
      </table>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
