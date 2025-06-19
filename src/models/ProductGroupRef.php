<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Product Group Ref.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $product_id
 * @property integer $group_id
 */
class ProductGroupRef extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_product_group_ref}}';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-productgroupref';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'group_id'], 'required'],
            [['product_id', 'group_id'], 'integer'],
            [['product_id', 'group_id'], 'unique', 'targetAttribute' => ['product_id', 'group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['']],
            [['create', 'update'], ['']],
            ['delete', false],
        ];
    }
}
