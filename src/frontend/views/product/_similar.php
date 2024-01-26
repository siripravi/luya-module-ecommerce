<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 02.04.17
 * Time: 22:03
 *
 * @var $similar dench\products\models\Product[]
 * @var $viewed boolean
 */

use siripravi\ecommerce\frontend\widgets\ProductCard;

?>
<!--
<php if ($viewed): ?>
    <div class="h1 text-center mt-4"><= Yii::t('app', 'You looked through') ?></div>
<php else: ?>
    <div class="h1 text-center mt-4"><= Yii::t('app', 'Similar products') ?></div>
<php endif; ?>
-->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You may also be interested in</span></h2>
    </div>
    <div class="row">
        <?php foreach ($similar as $product) : ?>
            <div class="col-md-6 col-lg-4">
                <?= ProductCard::widget([
                    'model' => $product,
                    'link' => ['/product/' . $product->slug],
                ]);
                ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>