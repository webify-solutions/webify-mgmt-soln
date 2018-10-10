<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Issues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issue'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Edit Issue'), ['action' => 'edit', $issue->id]) ?> </li>
        <li><?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $issue->id],
          ['confirm' => __('Are you sure you want to delete {0}?', $issue->subject)]
        ) ?></li>
    </ul>
</nav>
<div class="issues view large-9 medium-8 columns content">
    <h3><?= __('Issue') ?></h3>
    <table class="vertical-table">
      <tr>
          <th scope="row"><?= __('Title') ?></th>
          <td><?= h($issue->subject) ?></td>
      </tr>
      <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $issue->has('organization') ? $this->Html->link($issue->organization->name, ['controller' => 'Organization', 'action' => 'view', $issue->organization->id]) : '' ?></td>
        </tr>
      <?php endif; ?>
      <tr>
          <th scope="row"><?= __('Customer') ?></th>
          <td><?= $issue->has('customer') ? $this->Html->link($issue->customer->name, ['controller' => 'Customer', 'action' => 'view', $issue->customer->id]) : '' ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Product') ?></th>
          <td><?= $issue->has('product') ? $this->Html->link($issue->product->name, ['controller' => 'Product', 'action' => 'view', $issue->product->id]) : '' ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Technician') ?></th>
          <td><?= $issue->has('user') ? $this->Html->link($issue->user->name, ['controller' => 'User', 'action' => 'view', $issue->user->id]) : '' ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Status') ?></th>
          <td><?= h($issue->status) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Created At') ?></th>
          <td><?= h($issue->created_at) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Last Updated') ?></th>
          <td><?= h($issue->last_updated) ?></td>
      </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($issue->description)); ?>
    </div>
</div>
