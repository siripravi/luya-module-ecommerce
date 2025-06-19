<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Brand.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $name
 * @property integer $image_id
 * @property integer $position
 * @property tinyint $enabled
 */
class Brand extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_brand';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-brand';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'image_id' => Yii::t('app', 'Image ID'),
            'position' => Yii::t('app', 'Position'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'position', 'enabled'], 'integer'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'image_id' => 'image',
            'name'     =>  'text',
            'position' => 'number',
            'enabled' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['image_id', 'name', 'position', 'enabled']],
            [['create', 'update'], ['name', 'image_id', 'position', 'enabled']],
            ['delete', false],
        ];
    }
}
