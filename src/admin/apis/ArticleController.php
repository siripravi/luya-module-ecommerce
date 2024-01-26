<?php

namespace siripravi\ecommerce\admin\apis;

use yii\helpers\Json;

/**
 * Article Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ArticleController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'siripravi\ecommerce\models\Article';

    /**
     *
     * @param unknown $id
     * @return unknown
     */
    public function actionFeatures($id)
    {
        $model = $this->findModel($id);

        $data = [];

        foreach ($model->getFeatures()->all() as $set) {
            $data[] = [
                'set' => $set,
                'attributes' => [], // $set->values,  
            ];
        }
        //echo "<pre>"; print_r($data);die;
        return $data;
    }

    public function formatData($valData)
    {
        $data = [];
        foreach ($valData as $value) {
            $data[$value->feature_id][$value->id] = $value;
        }


        foreach ($valData as $i => $data) {
            $values = [];
            foreach ($data as $j => $val) {
                $values[] = $data[$j]->name;
            }
            $valData["values_json"] = Json::encode($values);
        }

        return $valData;
    }
}
