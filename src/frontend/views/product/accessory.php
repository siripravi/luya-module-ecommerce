<?php

/* @var $this yii\web\View */
/* @var $model dench\products\models\Product */
/* @var $similar dench\products\models\Product[] */
/* @var $viewed boolean */

echo $this->render('_breadcrumbs', [
    'model' => $model,
]);

?>

<div class="row product-detail">

    <?= $this->render('_photo', [
        'model' => $model,
    ]) ?>

    <div class="col-md-12 col-lg-5 mx-auto single-details">
        <h1 class="mb-3"><?= $model->h1 ?></h1>
        <?= $this->render('_feature', [
            'model' => $model,
        ]) ?>

        <?= $this->render('_text', [
            'name' => $model->name,
            'text' => $model->text,
        ]) ?>

        <?= $this->render('_price', [
            'model' => $model,
            'rating' => $rating
        ]) ?>

        <?= $this->render('_complects', [
            'complects' => $model->complects,
        ]) ?>

        <?= $this->render('_options', [
            'options' => $model->options,
        ]) ?>
    </div>
</div>

<?= $this->render('_similar', [
    'viewed' => $viewed,
    'similar' => $similar,
]) ?>