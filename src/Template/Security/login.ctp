<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="user view large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Security') ?></legend>
        <?php
            echo $this->Form->control('login_name');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button('Security') ?>
    <?= $this->Form->end() ?>
</div>
