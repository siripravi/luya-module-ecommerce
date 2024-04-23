<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\SelectRelationActiveQuery;
/**
 * Feature Group Ref.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $feature_id
 * @property integer $group_id
 * @property integer $position
 *  @property integer $is_base
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
            'position' => Yii::t('app', 'Position'),
            'is_base' => Yii::t('app', 'Main?'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'group_id','position','is_base'], 'required'],
            [['feature_id', 'group_id','position','is_base'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [           
            'feature_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getFeature(), 'labelField' => ['name'], 'asyncList' => true],
            'group_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getGroup(), 'labelField' => ['name'], 'asyncList' => true],
            'position'  => 'number',
            'is_base' => ['toggleStatus', 'initValue' => 0],
        ];
    }


    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['feature_id', 'group_id','position','is_base']],
            [['create', 'update'], ['feature_id', 'position','is_base']],
            ['delete', false],
        ];
    }

    /**
     * @return Feature
     */
    public function getFeature()
    {
        return $this->hasOne(Feature::class, ['id' => 'feature_id']);
    }

     /**
     * @return Feature
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }
}
