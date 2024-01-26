<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Product Related.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $product_id
 * @property integer $related_id
 * @property integer $position
 */
class ProductRelatedRef extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_product_related_ref';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-productrelated';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'related_id' => Yii::t('app', 'Related ID'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'related_id'], 'required'],
            [['product_id', 'related_id', 'position'], 'integer'],
            [['product_id', 'related_id'], 'unique', 'targetAttribute' => ['product_id', 'related_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'position' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['position']],
            [['create', 'update'], ['position']],
            ['delete', false],
        ];
    }
}
