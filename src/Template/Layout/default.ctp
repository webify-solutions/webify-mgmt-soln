<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$appName = 'Webify Management';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $appName ?> |
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('base.extension.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->Html->script('jquery.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?= $appName ?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <?php if(isset($loggedUser)) : ?>
                <ul class="left">
                    <li><?= $this->Html->link(__('Dashboard'), ['controller' => 'Dashboard', 'action' => 'index'])?></li>
                    <?php if(in_array('Customer', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customer', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('Group', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Groups'), ['controller' => 'Group', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('Product', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Products'), ['controller' => 'Product', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('Order', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Orders'), ['controller' => 'Order', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('Invoice', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Invoices'), ['controller' => 'Invoice', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('Payment', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Payments'), ['controller' => 'Payment', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('SupportCase', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Support Case'), ['controller' => 'SupportCase', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('User', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Users'), ['controller' => 'User', 'action' => 'index'])?></li>
                    <?php endif; ?>
                    <?php if(in_array('Organization', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('Organizations'), ['controller' => 'Organization', 'action' => 'index']) ?></li>
                    <?php endif; ?>
                    <?php if(in_array('MyOrganization', $loggedUser['active_features'], true)) : ?>
                        <li><?= $this->Html->link(__('My Organization'), ['controller' => 'MyOrganization', 'action' => 'view', $loggedUser['organization_id']]) ?></li>
                    <?php endif; ?>

                </ul>
                <ul class="right">
                    <li class="logged-user"><?= $loggedUser['login_name'] ?></li>
                    <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Security', 'action' => 'logout'])?></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <?= $this->fetch('scriptBottom') ?>
    <?= $this->fetch('cssBottom') ?>
</body>
</html>
