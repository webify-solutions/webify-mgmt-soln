<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue[]|\Cake\Collection\CollectionInterface $issues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Issue'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="issues index large-9 medium-8 columns content">
    <h3><?= __('Issues') ?></h3>
    <table id='issue_table' cellpadding="0" cellspacing="0" class='display'>
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
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
        </thead>
        <tbody>
          <?php foreach ($issues as $issue): ?>
            <tr>
              <td class="actions">

                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $issue->id]) ?>
                  <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $issue->id],
                    ['confirm' => __('Are you sure you want to delete {0}?', $issue->issue_number)]
                  ) ?>
              </td>
              <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                <td><?= $issue->has('organization') ? $this->Html->link($issue->organization->name, ['controller' => 'Organization', 'action' => 'view', $issue->organization->id]) : '' ?></td>
              <?php endif; ?>
              <td><?= $this->Html->link(h($issue->issue_number), ['action' => 'view', $issue->id]) ?></td>
              <td><?= $issue->has('product') ? $this->Html->link($issue->product->name, ['controller' => 'Product', 'action' => 'view', $issue->product->id]) : '' ?></td>
              <td><?= $issue->has('customer') ? $this->Html->link($issue->customer->name, ['controller' => 'Customer', 'action' => 'view', $issue->customer->id]) : '' ?></td>
              <td><?= $issue->has('user') ? $this->Html->link($issue->user->name, ['controller' => 'User', 'action' => 'view', $issue->user->id]) : '' ?></td>
              <td><?= h($issue->status) ?></td>
              <td><?= h($issue->description) ?></td>
              <td><?= h($issue->last_updated) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
    <?php $this->Html->script('Issues/index.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('datatables.min.js', ['block' => 'scriptBottom']) ?>
    <?php $this->Html->css('datatables.min.css', ['block' => 'cssBottom']) ?>
</div>
