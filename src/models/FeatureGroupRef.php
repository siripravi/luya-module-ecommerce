<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Feature Group Ref.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $feature_id
 * @property integer $group_id
 */
class FeatureGroupRef extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_feature_group_ref}}';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-featuregroupref';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_id' => Yii::t('app', 'Feature ID'),
            'group_id' => Yii::t('app', 'group ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'group_id'], 'required'],
            [['feature_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'feature_id' => 'number',
            'group_id' => 'number',
        ];
    }

    
    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['feature_id', 'group_id']],
            [['create', 'update'], ['feature_id', 'group_id']],
            ['delete', false],
        ];
    }
}