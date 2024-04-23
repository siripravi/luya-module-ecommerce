<?php

/**
 * View file for block: HeadTeaserBlock 
 *
 * File has been created with `block/create` command on LUYA version 1.0.0-RC3. 
 *
 *
 * @var $this \luya\cms\base\PhpBlockView
 */

use yii\widgets\ListView;
use siripravi\ecommerce\frontend\widgets\ProductCard;
?>

<?php
$similar = $this->extraValue('elements')['similar'];
/*if ($this->extraValue('elements')['dataProvider']) {
    echo ListView::widget([
        'dataProvider' => $this->extraValue('elements')['dataProvider'],
        'itemView' => '@catalog/views/blocks/_item',
        'layout' => '<div class="row featured">{items}</div>',
        'emptyTextOptions' => [
            'class' => 'alert alert-danger',
        ],
        'options' => ['class' => 'products home-products container'],
        'itemOptions' => [
            'class' => 'col-sm-6 col',
        ]
    ]);
}*/
?>
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