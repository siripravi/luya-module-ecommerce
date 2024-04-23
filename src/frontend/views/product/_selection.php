<?php

use yii\widgets\Pjax;
use yii\base\Widget;
use yii\helpers\Html;
//use kartik\widgets\Select2;
use siripravi\ecommerce\models\Value;
use siripravi\ecommerce\models\ArticleValueRef;
use conquer\select2\Select2Widget;
use siripravi\ecommerce\frontend\widgets\PriceTable;
?>

<?php Pjax::begin(['id' => 'feature-pjax']); ?>
    <?php Widget::$autoIdPrefix = 'f'; ?>
        <?php if (empty($features)) : ?>
            <?= Html::tag('div', Yii::t('app', 'Select a category!'), ['class' => 'alert alert-danger']) ?>
        <?php else : ?>
           
                    <?php foreach ($features as $feature) : ?>
                        
                                <?php
                                /*  $value_ids = [];
                                    $index = $modelVariant->id;
                                    $list = Value::getList($feature->id);
                                    $value_ids = $modelVariant->value_ids;       
                                  */
                                ?>
                                <?= PriceTable::widget([
                                  'id' => 'price' . $modelVariant->id,
                                  'article' => $modelVariant,
                                  'available' => $available,
                                  'feature_id' => $feature->id,
                                  'feature_name'  => $feature->name,
                                  'value_ids'  => [], //$value_ids,
                                  'list'       => [], //$list
                                ]) ?>
                     <?php endforeach; ?>
                  
        <?php endif; ?>
   <?php Widget::$autoIdPrefix = 'w'; ?>
 <?php Pjax::end(); ?>
