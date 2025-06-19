<?php

use yii\widgets\LinkPager;
use luya\admin\filters\MediumCrop;

/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($provider->models as $item) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img src="<?= $item->getImage()->applyFilter(MediumCrop::identifier())->source; ?>" class="card-img-top" />
                       
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
        </div>
        <?= LinkPager::widget(['pagination' => $provider->pagination]); ?>
    </div>
</section>