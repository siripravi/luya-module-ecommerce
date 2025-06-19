<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Tabs;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model dench\products\models\Product */
/* @var $similar dench\products\models\Product[] */
/* @var $viewed boolean */

?>

<?php echo $this->render('_breadcrumbs', [
    'model' => $model,
]); ?>

<!--<div class="breadcrumbs">
    <a class="back hide-on-320" href="/menu">
        <img src="/image/site/img/back-mobile.png" class="visible-xs" alt="" width="63" height="64">
        <span>Go Back</span>
    </a>
</div> -->

<h2 class="mb-3 text-center heading"><?= $model->name ?></h2>

<div class="container" style="margin-top:44px;">
    <div class="row product-detail">

        <!--php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'validateOnChange' => true,
            'validateOnBlur' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'product-form',
            ]
        ]); ?-->
        <?php $items = [];

        foreach ($model->articles as $index => $article) {
            $items[] = [
                'label' => $article->name,
                'content' => $this->render("_article", ['modelVariant' => $article, 'features' => $features]),  //, 'form' => $form]),
                'active' => ($index == 0)
            ];
        }
        ?>

        <?php
        echo Tabs::widget([
            //'navType' => 'nav-tabs card-header full-width-tabs',
            'navType' => 'nav nav-pills nav-fill',
            'items' =>      $items,
            'tabContentOptions' => ['class' => 'p-4'],
            //  'itemOptions' => ['class'=>'card-body'],
            'headerOptions' => ['class' => 'use-max-space']

        ]);
        ?>

        <!--?php ActiveForm::end(); ?-->
    </div>
</div>
<?= $this->render('_photo', [
            'model' => $model,
        ]) ?>

<!--?= $this->render('_text', [
            'name' => $model->name,
            'text' => $model->text,
        ]) ?-->
<!--?= $this->render('_price', [
            'model' => $model,
           // 'rating' => $rating
        ]) ?-->
<!--?= $this->render('_feature_simple', [
            'model' => $model,
        ]) ?-->

<!--?= $this->render('_complects', [
    'complects' => $model->related,
]) ?-->

<!--= $this->render('_options', [
    'options' => $model->options,
]) ?-->

<?= $this->render('_similar', [
    'viewed' => $viewed,
    'similar' => $similar,
]) ?>