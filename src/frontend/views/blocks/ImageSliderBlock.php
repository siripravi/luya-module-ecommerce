<?php

use siripravi\ecommerce\frontend\widgets\Carousel;

$imageInfo = $this->extraValue('articleImages');
/*
echo "<pre>";
print_r($imageInfo);
echo "</pre>";
*/
/*
echo Carousel::widget([
    'items' =>
    $imageInfo['images'],
    'thumbnails'  => $imageInfo['thumbnails'],
    'options' => [
        'data-interval' => 3, 'data-bs-ride' => 'scroll', 'class' => 'carousel product_img_slide',
    ],
    //'options'  => ['class' => 'carousel product_img_slide','ride'=>true]

]);*/

?>
<div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
    <div class="row py-3 shadow-5">
        <div class="col-12 mb-1">
            <div class="lightbox">
            <img src="<?= $imageInfo['images'][0]['src']; ?>" class="ecommerce-gallery-main-img active w-100" />
            
            </div>
        </div>
        <?php foreach ($imageInfo['images'] as $idx => $img) : ?>
            <div class="col-3 mt-1 multi-carousel-item">
                <?php $active = ($idx == 0) ? " active " : "";  ?>
                <img src="<?= $img['src']; ?>" data-mdb-img="<?= $img['src']; ?>" class="w-100 <?= $active; ?>" />
            </div>
        <?php endforeach; ?>
    </div>
</div>
<p class="note note-danger">
          <strong>Note danger:</strong> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Cum doloremque officia laboriosam. Itaque ex obcaecati architecto! Qui necessitatibus
          delectus placeat illo rem id nisi consequatur esse, sint perspiciatis soluta porro?
        </p>