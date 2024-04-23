<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 13:30
 *
 * @var $model dench\products\models\Product
 * @var $link string
 * @var $rating array
 */

use app\widgets\PriceTable;
use app\helpers\ImageHelper;
use luya\admin\filters\MediumCrop;
use yii\helpers\Html;

$variant = @$model->articles[0];
$price = 1;
if (@$model->articles[0]->price) {
    $price = $model->articles[0]->price;
    $available = 0;
    foreach ($model->articles as $variant) {
        if ($variant->enabled) {
            if ($variant->available < 0) {
                $available = -1;
            }
            if ($variant->available > 0) {
                $available = 1;
                break;
            }
        }
    }
}

?>
<!--
<div class="img-wrapper">
    <a data-productid="<= $model->id; ?>" href='<= "/product/" . $model->slug; ?>'>
        <php echo Html::img(
            Yii::$app->storage->getImage($model->cover_image_id)->source,
            ["width" => 292, "height" => 204]
        ) ?>
    </a>
    <span class="price"><php echo $price; ?><br><span class="per">/ea</span></span>
</div>
<span class="info"><= $model->groups[0]->name; ?></span>
<p class="name"><a href="#"><= $model->article->name; ?></a></p>
        -->

<?php foreach ($model->articles as $item) : ?>
    <div class="col mb-5 shadow-sm p-3 mb-5 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card h-100">
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
            <!-- Product image-->
            <img src="<?= $item->getImage()->applyFilter(MediumCrop::identifier())->source; ?>" class="card-img-top object-fit-cover" />

            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder"><?= $item->name; ?></h5>
                    <!-- Product price-->
                    $40.00 - $80.00
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <a class="btn btn-outline-dark mt-auto" href="<?= $item->detailUrl; ?>">View Detail</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>