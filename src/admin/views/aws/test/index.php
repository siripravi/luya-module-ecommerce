<?php

use luya\admin\ngrest\aw\ActiveWindowFormWidget;
use luya\helpers\Json;
use luya\admin\helpers\Angular;
?>

<div class="container" ng-controller="InlineController">
    <div class="row">

        <?php echo Angular::directive('article-feature', [
            'ecommerce' => 1,
            'model' => 'data.update.selected', 'tree' => 'categories'
        ]);  ?>
        <?php $form = ActiveWindowFormWidget::begin(['callback' => 'index', 'buttonValue' => 'Submit']); ?>
        <?= $form->field('firstname', 'Firstname'); ?>
        <?= $form->field('password', 'Password')->passwordInput(); ?>
        <?= $form->field('message', 'Message')->textarea(); ?>
        <?php $form::end(); ?>
    </div>
</div>