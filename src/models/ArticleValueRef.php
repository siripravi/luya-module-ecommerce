<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use yii\helpers\ArrayHelper;

/**
 * Article Value Ref.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $article_id
 * @property integer $value_id
 */
class ArticleValueRef extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-articlevalueref';
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_article_value_ref';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => Yii::t('app', 'Article ID'),
            'value_id' => Yii::t('app', 'Value ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'value_id'], 'required'],
            [['article_id', 'value_id'], 'integer'],
            [['article_id', 'value_id'], 'unique', 'targetAttribute' => ['article_id', 'value_id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(Value::class, ['id' => 'value_id']);
    }

    /**
     * @param integer|null $feature_id
     * @return array
     */
    public static function getList($article_id)
    {
        $values = self::find()->where(['article_id' => $article_id])->all();

        return ArrayHelper::getColumn($values, function ($element) {
            return strval($element['value_id']);
        });
    }
}
