<?php
use app\helpers\ImageHelper;

use luya\admin\filters\MediumCrop;
use yii\helpers\Url;
/**
 * View file for block: GroupBlock
 *
 * File has been created with `block/create` command on LUYA version 1.0.0.
 *
 * @param $this->varValue('elements');
 *
 * @var $this \luya\cms\base\PhpBlockView
 */
//\siripravi\ecommerce\frontend\assets\Main::register(Yii::$app->view);
?>
<div class="container">
    <div class="page-content">
        <div class="col-md-12 bd-highlight align-self-center position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h3 class="display-1 fw-bold">We Sell These!</h3>
            <h2>right direction</h2>
            <!--<p style="font-size: 0.8rem;">Lorem ipsum deserunt mollit anim id est laborum.</p>-->
        </div>
        <div class="row g-5">
            <?php foreach ($this->extraValue('elements')['categories'] as $key => $element) : ?>
                <div class="col-lg-4 col-md-6 shadow-sm p-3 mb-3 shadow p-3 bg-body-tertiary rounded">
                    <div class="card h-100">
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?= $element->slug; ?></div>
                        <a data-category="<?= $element->slug; ?>" href="<?= Url::to(['/catalog/category/view', 'slug'=>$element->slug]); ?>">
                            <!--<img class="card-img-top" src="<= Yii::$app->storage->getImage($element->cover_image_id)->source ?>" alt="">-->
                            <img src="<?= Yii::$app->storage->getImage($element->cover_image_id)->applyFilter(MediumCrop::identifier())->source; ?>" class="card-img-top object-fit-cover" />
                        </a>
                        <div class="card-body p-0">
                            <p class="card-title"><?= $element->name; ?></p>
                          <!--  <p class="card-text"> of the card's content.</p>
                            <a href="#" class="btn btn-primary">View</a> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h2>HEADER2</h2>
        <div class="pb-4">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
</div>
<!--
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Our Menu</h2>
            <h1 class="display-4 text-uppercase">We Sell These</h1>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">            
        </div>
    </div>
</section>
-->