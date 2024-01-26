<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 04.02.18
 * Time: 17:55
 *
 * @var $baseUrl string
 */

?>
<div class="h1"><?= Yii::t('app', 'Order Process') ?></div>
<div class="features">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon"><img src="<?= '/image/site/how-1.png' ?>" alt="<?= Yii::t('app', 'Ordering goods') ?>"></div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title"><?= Yii::t('app', 'Ordering goods') ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon ml-auto mr-auto"><img src="<?= '/image/site/how-2.png' ?>" alt="<?= Yii::t('app', 'Payment') ?>"></div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title"><?= Yii::t('app', 'Payment') ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon"><img src="<?= '/image/site/how-3.png' ?>" alt="<?= Yii::t('app', 'Delivery') ?>"></div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title"><?= Yii::t('app', 'Delivery') ?><br></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>