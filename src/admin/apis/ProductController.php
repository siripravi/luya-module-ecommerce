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

    /**
     *
     * @param unknown $id
     * @return unknown
     */
    public function actionFeatures($id)
    {
        $features = [];
        $value_ids = [];
        $model = Article::find(['id' => $id])->one();
        $product = $model->product;
        $value_ids = ArticleValueRef::getList($id);

        if ($product->group_ids)
            $features = Feature::getObjectList(true, $product->group_ids);
        else
            $features = [];

        $data = [];
        $featureVals = [];

        foreach ($features as $set) {

            $featureVals[] = [
                'set' => $set,
                'attributes' => Value::getList($set->id),
                'preSel'  => $value_ids
            ];
        }
        $data['fVals'] = $featureVals;
        $data['preSel'] = array_values($value_ids);
        $data['selected'] = $this->setAttributes($value_ids, $model->getValues());
        return $data;
    }

    public function setAttributes($value_ids, $featurs)
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
