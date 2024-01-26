<?php

/** @var $this yii\web\View */
/** @var $page app\modules\main\components\Page */
/** @var $categories dench\products\models\Category[] */
/** @var $dataProvider yii\data\ActiveDataProvider */


use siripravi\ecommerce\models\Group;
use yii\helpers\Url;
use yii\widgets\ListView;
use luya\admin\filters\SmallThumbnail;
//$this->params['breadcrumbs'][] = $page->name;
?>
<h1 class="mb-3"><!--?= $page->title ?--></h1>

<!--?php if ($page->short) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <= $page->short ?>
      </div>
    </div>  
<php endif; ?-->
<div class="row categories mb-4">
    <?php foreach ($categories as $category) : ?>
        <?php
        $url = Url::to((count($category->categories)) ? ['category/pod', 'slug' => $category->slug] : ['category/view', 'slug' => $category->slug]);
        ?>
        <div class="col-6 col-sm-4 col-lg-3 pb-3 px-1 px-sm-2">
            <div class="card block-link">
                <a href="<?= $url ?>" rel="nofollow">
                <?php if ($category->cover_image_id) { ?>
                    <img src="<?= Yii::$app->storage->getImage($category->cover_image_id)->applyFilter(SmallThumbnail::identifier())->source ?>" alt="<?= $category->name ?>" title="<?= $category->name ?>" class="card-img rounded-0 img-fluid">
                <?php } else { ?>
                    <img class="img-fluid" src="<?= Yii::$app->params['image']['size']['category']['none'] ?>" alt="">
                <?php } ?>               
                </a>
                <div class="card-footer bg-gradient-dark text-center px-0 px-sm-1">
                    <a href="<?= $url ?>" class="text-white"><?= $category->name ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'layout' => "{items}\n{pager}",
    'emptyTextOptions' => [
        'class' => 'alert alert-danger',
    ],
    'options' => [
        'class' => 'list-group mb-4',
    ],
    'itemOptions' => [
        'class' => 'list-group-item',
    ],
]);
?>
<!--
<php if (!Yii::$app->request->get('page') && $page->text) : ?>
    <div class="card mb-3">
        <div class="page-seo card-body">
            <h2><= $page->title ?></h2>
			 <= $page->text ?>
        </div>
    </div>
<php endif; ?>
-->