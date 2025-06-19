<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 13:27
 */

namespace siripravi\ecommerce\frontend\widgets;

use siripravi\ecommerce\models\Review;
use siripravi\ecommerce\models\Product;
use yii\base\Widget;
use yii\helpers\Url;

class ProductCard extends Widget
{
    /**
     * @var $model Product
     */
    public $model;

    public $link;

    public function init()
    {
        $this->link = Url::to($this->link);
    }

    public function run()
    {
         $rating = Review::find()
            ->select(['SUM(rating) sum', 'COUNT(*) count'])
            ->where(['status' => Review::STATUS_PUBLISHED, 'product_id' => $this->model->id])
            ->asArray()
            ->one();
           
        if (!empty($rating['count'])) {
            $rating['value'] = round($rating['sum'] / $rating['count'], 1);
        } else {
            $rating = [
                'count' => 0,
                'value' => 0,
            ];
        }

        return $this->render('productCard', [
            'model' => $this->model,
            'link' => $this->link,
            'rating' => $rating,
        ]);
    }
}
