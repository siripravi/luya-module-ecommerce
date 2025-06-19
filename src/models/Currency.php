<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Currency.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property string $code
 * @property decimal $rate
 * @property integer $position
 * @property string $name
 * @property string $before
 * @property string $after
 * @property tinyint $enabled
 */
class Currency extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_currency}}';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-currency';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'rate' => Yii::t('app', 'Rate'),
            'position' => Yii::t('app', 'Position'),
            'name' => Yii::t('app', 'Name'),
            'before' => Yii::t('app', 'Before'),
            'after' => Yii::t('app', 'After'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'rate', 'name'], 'required'],
            [['rate'], 'number'],
            [['position', 'enabled'], 'integer'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
            [['before', 'after'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'code' => 'text',
            'rate' => 'decimal',
            'position' => 'number',
            'name' => 'text',
            'before' => 'text',
            'after' => 'text',
            'enabled' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['code', 'rate', 'position', 'name', 'before', 'after', 'enabled']],
            [['create', 'update'], ['code', 'rate', 'position', 'name', 'before', 'after', 'enabled']],
            ['delete', false],
        ];
    }
}
