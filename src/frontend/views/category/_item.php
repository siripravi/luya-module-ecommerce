<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 13:24
 *
 * @var app\models\Product $model
 */

use siripravi\ecommerce\frontend\widgets\ProductCard;

echo ProductCard::widget([
    'model' => $model,
    'link' => ['/product/' . $model->slug],
]);
