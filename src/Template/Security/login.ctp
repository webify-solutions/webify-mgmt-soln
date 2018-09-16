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
        <legend><?= __('Log In') ?></legend>
        <?php
            echo $this->Form->control('login_name');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button('Log In', array( 'class' => 'button success')) ?>
    <?= $this->Form->end() ?>
</div>
