<?php

namespace siripravi\ecommerce\admin\apis;

use siripravi\ecommerce\models\Article;
use siripravi\ecommerce\models\Feature;
use siripravi\ecommerce\models\Value;
use siripravi\ecommerce\models\ArticleValueRef;
use yii\helpers\JSON;

/**
 * Product Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ProductController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'siripravi\ecommerce\models\Product';

    public function actionFeatures($id)
{
    $model = Article::findOne($id);
    if (!$model) {
        throw new \yii\web\NotFoundHttpException("Article not found for ID $id.");
    }

    $product = $model->product;
    $value_ids = ArticleValueRef::getList($id);

    $features = [];
    if (!empty($product) && !empty($product->group_ids)) {
        $features = Feature::getList(true, $product->group_ids);
    }

    $featureVals = [];
\yii::debug($features, __METHOD__);
    foreach ($features as $key => $set) {
        $featureVals[] = [
            'set' => $set,
            'attributes' => Value::getList($key),
            'preSel' => $value_ids,
        ];
    }

    return [
        'fVals' => $featureVals,
        'preSel' => array_values($value_ids),
        'selected' => $this->mapSelectedAttributes($value_ids, $model->getValues()),
    ];
}

    public function mapSelectedAttributes($value_ids, $featurs)
    {
        $data = [];
        foreach ($featurs as $key => $value) {
            $keys = array_keys($value);
            foreach ($keys as $k) {
                if (in_array($k, $value_ids)) {
                    $data[$key][$k] = 1;
                } else {
                    $data[$key][$k] = 0;
                }
            }
        }
        return $data;
    }
}
