<?php

namespace siripravi\ecommerce\frontend\components;

use Yii;
use yii\behaviors\TimestampBehavior;
use siripravi\ecommerce\admin\behaviors\ManyToManyBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\db\Expression;

class Product extends ActiveRecord
{
    private $_fileEnabled = null;
    private $_fileName = null;
    private $_price;
    private $_currency;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_product';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'group_ids' => ['groups'],
                ]
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['brand_id', 'created_at', 'updated_at', 'price_from', 'position', 'enabled'], 'integer'],
            [['name', 'slug', 'view', 'text'], 'string', 'max' => 255],
            [['adminGroups'], 'safe'],
            [['group_ids'], 'each', 'rule' => ['integer']]
        ];
    }

    public static function viewPage($id)
    {
        if (is_numeric($id)) {
            $page = self::find()->where(['slug' => $id])->one();
        } else {
            $page = self::find()->where(['slug' => $id])->one();
            //echo $page->id; die;  //->createCommand()->getRawSql(); die;
        }
        if ($page === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->view->params['page'] = $page;
        Yii::$app->view->title = $page->title;
        if ($page->description) {
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $page->description
            ]);
        }
        if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->keywords
            ]);
        }
        return $page;
    }
}
