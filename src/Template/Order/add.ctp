<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Orders'), ['controller' => 'Order', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="order form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            if ($organization != null) {
                echo $this->Form->control('organization_id', ['options' => $organization, 'empty' => true]);
            }
            echo $this->Form->control('customer_id', ['options' => $customer, 'empty' => true]);
            echo $this->Form->control('type', ['options' => $types, 'empty' => true]);
            echo '<div class="period-picker hidden">';
            echo '<span class="type_period"> Reminder every </span>';
            echo $this->Form->control(
              'type_period',
              [
                'label' => '',
                'options' => $typePeriods,
                'empty' => true
              ]
            );
            echo '<span> month(s) </span>';
            echo '</div>';
            echo $this->Form->control(
              'order_date',
              [
                'empty' => false,
                'minYear' => date( 'Y') - 40,
                'maxYear' => date('Y')
              ]
            );
            echo $this->Form->control(
              'effective_date',
              [
                'empty' => false,
                'minYear' => date( 'Y') - 40,
                'maxYear' => date('Y')
              ]
            );
            echo $this->Form->control(
              'delivery_date',
              [
                'empty' => true,
                'minYear' => date( 'Y') - 40,
                'maxYear' => date('Y')
              ]
            );
            echo '<div class="hidden">' . $this->Form->control('currency', ['options' => $currencies, 'empty' => false]) . '</div>';
            echo $this->Form->control('order_discount');
            echo $this->Form->control(
              'order_discount_unit',
              [
                  'options' => $orderDiscountUnits,
                  'empty' => true
              ]
            );
            echo $this->Form->control('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php $this->Html->script('Order/add.js', ['block' => 'scriptBottom']); ?>
