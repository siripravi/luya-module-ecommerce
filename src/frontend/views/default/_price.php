<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 02.04.17
 * Time: 22:59
 *
 * @var $model dench\products\models\Product
 * @var $this yii\web\View
 * @var $rating array
 */

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use siripravi\ecommerce\models\ArticlePrice;
use yii\helpers\Url;
?>
<span class="rounded-5 rounded-top-0">HELLO WORLD!</span>
<div class="form xhidden-xs">
    <?php   
    //   print_r(ArticlePrice::getPriceList(6,8));
   //  print_r( $priceList = $article->getPricesDef());
  //   print_r(ArrayHelper::map($priceList,'feature_id','name','feature_id'));
     
    /*  $floor = floor($rating['value']);
            for ($i = 0; $i < $floor; $i++) {
                echo '<i class="fa fa-star text-warning"></i> ';
            }
            if ($floor < $rating['value']) {
                echo '<i class="fa fa-star-half text-warning"></i> ';
            }*/
    ?>
    <!--  <a href="#reviews" class="text-muted ml-2"><= Yii::t('app', '{0, plural, =0{нет отзывов} =1{1 отзыв} one{# отзыв} few{# отзыва} many{# отзывов} other{# отзывов}}', $rating['count']); ?></a>-->

    <?php Pjax::begin(['id' => 'feature-pjax']); ?>
        <div class="col-6" style="color:#323232;display: inline-block;padding-left:10px">
            <div style="padding-right: 0;">
                <span style="vertical-align:super;font-size:31px; padding-right:5px;" class="moneySymbol">₹</span>
                <span class="product-price moneyCal" data-inr="<?= $article->price; ?>" style="color: #222; font-size: 48px; font-weight: 600;" id="productPrice"><?= $article->price; ?></span>
            </div>
        </div>
        <?php if (empty($features)) : ?>
            <?= Html::tag('div', Yii::t('app', 'Select a category!'), ['class' => 'alert alert-danger']) ?>
        <?php else : 
             
            ?>
            <?php foreach ($features as $id => $feature) {
               $priceList = $article->getPricesDef($feature->id);
             //  echo "<pre>";
             //  print_r($priceList); die;
                echo "<h5>" . $feature->name . "</h5>";
                echo "<div class='card card-outline featSel p-4'>";
                echo "<div class='d-flex flex-wrap align-content-start'>";
                echo Html::radioList(
                    'buy[' . $article->product_id . '][' . $feature->id . ']',
                    "",
                    ArrayHelper::map($priceList, "price", "ftext" ),
                    [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            // $inpId = str_replace(["buy[","]"],"_",str_replace([']['], '_', $name));
                            $checked = ($index == 0 && $value > 0) ? 'checked' : '';
                            $return = '<div class="p-2 flex-fill fsel ' . $checked . '">';
                            $return .= '<input type="radio" id="'.$name.$index.'" class="btn-check" data-ftext="'.$label.'" name="'.$name.'" value="'.$value.'" title="click" autocomplete="off" ' . $checked . '>';
                            $return .= '<label class="btn btn-outline-warning" for="' . $name . $index . '">' . '<i class="bi bi-circle pe-2" style="font-size:34px;"></i><span class="text-dark">' . ucwords($label) . '</span></label>';
                            $return .= "</div>";
                            return $return;
                        },
                        'class' => 'd-flex text-inline'
                    ]
                );
                echo "</div>";
                echo "</div>";
            }
            ?>
    <?php endif; ?>
    <?php Pjax::end(); ?>
    <div class="row">
        <?php if ($article->available !== 0) : ?>
            <form id="cart-form" action="<?= Url::to('/cart/bag/index');?>">
            <button type="submit" data-key="" data-ftext="" data-product="<?= $article->id; ?>" data-price="<?= $article->price; ?>" data-bs-target="#offcanvasCart" data-bs-toggle="offcanvas" class="btn btn-success btn-buy" rel="price<?= $article->id ?>">
                <?= $article->available > 0 ? Yii::t('app', 'Order This') : Yii::t('app', 'Buy This Now') ?></button>
                </form>    
        <?php endif; ?>
    </div>
</div>