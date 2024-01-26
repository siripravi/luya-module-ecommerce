<?php
use luya\admin\filters\MediumCrop;
use luya\admin\filters\LargeCrop;
use luya\admin\filters\LargeThumbnail;
use luya\admin\filters\MediumThumbnail;
use siripravi\ecommerce\models\Article;
use siripravi\ecommerce\frontend\widgets\ProductCard;
use luya\web\View;
use siripravi\ecommerce\frontend\widgets\GalleryWidget;
use siripravi\ecommerce\frontend\widgets\Carousel;
use yii\helpers\Html;

/** @var View $this  */
/** @var Article $model */
?>

<?php if ($model->images) : ?>
    <?php $items = [];
    foreach ($model->images as $id => $photo) {
        $thumbnails[$id] = ['thumb' => $photo->image->applyFilter(MediumCrop::identifier())->source];
        $items[] = [
            'content' => Html::img($photo->image->applyFilter(LargeCrop::identifier())->source,['class'=>'img-fluid rounded mx-auto d-block']),
            'options' => [
                // 'title' => $photo->alt,
                'class' => ''
            ],
        ];
    }
    ?>
    <div class="row">        
        <div class="col-lg-6 mt-5">
            <?php echo Carousel::widget([
                'items' =>
                $items,
                'thumbnails'  => $thumbnails,
                'options' => [
                    'data-interval' => 3, 'data-bs-ride' => 'scroll', 'class' => 'carousel product_img_slide',
                ],
                //'options'  => ['class' => 'carousel product_img_slide','ride'=>true]

            ]);  ?>
        </div>
    <?php endif; ?>
    <div class="col-lg-6">
        <h1><?= $model->name; ?></h1>
        <?= $model->text; ?>
        <div class="row" style="display:flex;margin-top: -11px;margin-bottom: 20px">
            <?= $this->render('_price', [
                'article' => $model,
                'features' => $features,
                // 'rating' => $rating,
                
            ]) ?>
        </div>
    </div>
    <!-- SIMILAR PRODUCTS  -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="xsection-title px-5"><span class="px-2">You may also be interested in</span></h2>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($similar as $product) : ?>
                <?= ProductCard::widget([
                    'model' => $product,
                    'link' => ['/product/' . $product->slug],
                ]);
                ?>
            <?php endforeach; ?>
        </div>
    </div>