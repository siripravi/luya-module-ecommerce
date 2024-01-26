<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 02.04.17
 * Time: 22:52
 *
 * @var $model dench\products\models\Product
 */

use siripravi\ecommerce\frontend\widgets\GalleryWidget;

?>
<div class="product-photo mb-3">
    <div class="photo">
        <?php if ($model->cover_image_id) { ?>
            <a class="gallery-item" href="<?= Yii::$app->storage->getImage($model->cover_image_id)->source ?>" data-size="500X400">
                <img class="img-fluid" src="<?= Yii::$app->storage->getImage($model->cover_image_id)->source; ?>" alt="<?= $model->name ?>" title="<?= $model->name ?>">
            </a>
        <?php } else { ?>
            <div class="thumbnail">
                <img class="img-fluid" src="/img/photo-default.png" alt="photo-default">
            </div>
        <?php } ?>
    </div>
</div>
<?php
$images = [];
foreach ($model->articles as $variant) {
    foreach ($variant->images as $image) {
        $images[] = $image;
    }
}
$items = [];
foreach ($images as $photo) {
    $items[] = [
        'image' => $photo->image->source,
        'thumb' => $photo->image->applyFilter('medium-thumbnail')->source,
        'width' => 800,
        'height' => 800,
        'title' => $photo->image->caption,
    ];
}
echo GalleryWidget::widget([
    'items' => $items,
    'options' => [
        'class' => 'gallery row mx-0',
    ],
    'itemOptions' => [
        'class' => 'img-thumbnail',
    ],
    'linkOptions' => [
        'class' => 'gallery-item col-lg-4 col-md-6 px-1',
    ],
]);
if (count($images) <= 1) {
    echo "<style>.gallery { display: none; }</style>";
}
?>