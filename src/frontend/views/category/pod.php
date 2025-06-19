<?php

/** @var $this yii\web\View */
/** @var $page app\components\Category */
/** @var $categories dench\products\models\Category[] */

use app\helpers\ImageHelper;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products'),
    'url' => ['category/index'],
];
$this->params['breadcrumbs'][] = $page->name;

$url_active = Url::to(['category/pod', 'slug' => $page->slug]);

$js = <<<JS
    $('.sidebar nav .nav-link[href="{$url_active}"]').addClass('active bg-gradient-primary text-white');
JS;
$this->registerJs($js);
?>
<section class="cat-list pt-6">
    <h1 class="mb-3"><?= $page->name ?></h1>

    <?php if ($page->text) : ?>
        <div class="card mb-3">
            <div class="card-body">
                <?= $page->text ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row categories">
        <?php foreach ($categories as $category) : ?>
            <div class="col-sm-6 col-lg-4 pb-3 px-2">
                <div class="card block-link">
                    <a href="<?= Url::to(['category/view', 'slug' => $category->slug]) ?>" rel="nofollow">
                        <?php if ($category->image) { ?>
                            <img src="<?= ImageHelper::thumb($category->image->id, 'category') ?>" class="card-img-top" alt="<?= $category->image->alt ? $category->image->alt : $category->name ?>" title="<?= $category->title ?>">
                        <?php } else { ?>
                            <img src="<?= Yii::$app->params['image']['size']['category']['none'] ?>" class="card-img-top" alt="">
                        <?php } ?>
                    </a>
                    <div class="card-footer bg-gradient-dark text-center">
                        <a href="<?= Url::to(['category/view', 'slug' => $category->slug]) ?>" class="text-white"><?= $category->name ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--
<php if (!Yii::$app->request->get('page') && $page->seo) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <= $page->seo ?>
        </div>
    </div>
<php endif; ?>
-->

</section>