<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use luya\admin\ngrest\plugins\SelectRelationActiveQuery;
use yii\behaviors\TimestampBehavior;
use siripravi\ecommerce\admin\behaviors\ManyToManyBehavior;
use yii\db\Expression;

/**
 * Product.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property text $name
 * @property string $slug
 * @property integer $brand_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $price_from
 * @property string $view
 * @property integer $position
 * @property tinyint $enabled
 */
class Product extends NgRestModel
{
    /**
     * @inheritdoc
     */
    //public $i18n = ['name','slug', 'view'];

    /**
     * @var array
     */
    public $adminGroups = [];
    public $adminRelated = [];
    /**
     * @var array
     */
    public $adminSets = [];

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
                    'related_ids' => ['related'],
                ]
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-product';
    }

    public function ngRestRelations()
    {
        //$query = Article::find()->where(['product_id'=>1]);
        // echo "<pre>"; print_r( $query); die;//->createCommand()->getRawSql(); die;
        return [
            ['label' => 'Articles', 'targetModel' => Article::class, 'apiEndpoint' => Article::ngRestApiEndpoint(), 'dataProvider' => $this->getArticles()],
            // ['label' => 'Related', 'targetModel' => ProductRelated::class,'apiEndpoint' => ProductRelated::ngRestApiEndpoint(), 'dataProvider' => $this->getRelated()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'cover_image_id' => Yii::t('app', 'Image'),
            'text' => Yii::t('app', 'text'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'price_from' => Yii::t('app', 'Price From'),
            'view' => Yii::t('app', 'View'),
            'position' => Yii::t('app', 'Position'),
            'enabled' => Yii::t('app', 'Enabled'),
            'adminGroups' => 'Categories',
            'adminRelated' => 'Related',
            //'adminSets' => 'Features',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['brand_id', 'created_at', 'updated_at', 'price_from', 'cover_image_id', 'position', 'enabled'], 'integer'],
            [['name', 'slug', 'view', 'text'], 'string', 'max' => 255],
            [['adminGroups'], 'safe'],
            [['adminRelated'], 'safe'],
            [['group_ids'], 'each', 'rule' => ['integer']],
            [['related_ids'], 'each', 'rule' => ['integer']]

        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'name'          => 'text',
            'slug'          => 'text',
            //'brand_id'    => 'number',
            'brand_id'  =>  ['class' => SelectRelationActiveQuery::class, 'query' => $this->getBrands(), 'labelField' => ['name'], 'asyncList' => true],
            //'brand_id'      => ['selectModel', 'modelClass' => Brand::class],
            'cover_image_id' => 'image',
            'created_at'    => 'number',
            'updated_at'    => 'number',
            'price_from'    => 'number',
            'view'          => 'text',
            'position'      => 'number',
            'enabled' => ['toggleStatus', 'initValue' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name', 'cover_image_id', 'brand_id', 'created_at', 'updated_at', 'price_from', 'view', 'position', 'enabled']],
            [['create', 'update'], ['name', 'slug', 'cover_image_id', 'adminGroups', 'adminRelated', 'brand_id', 'price_from', 'view', 'position', 'enabled']],
            ['delete', false],
        ];
    }

    public function ngRestExtraAttributeTypes()
    {
        return [
            'adminGroups' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getGroups(),
                'labelField' => ['name'],
            ],
            /*  'adminSets' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getSets(),
                'labelField' => ['name'],
            ]*/
            'adminRelated' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getRelated(),
                'labelField' => ['name'],
            ],
        ];
    }

    public function extraFields()
    {
        return ['adminGroups', 'adminRelated'];  //adminSets
    }

    public function getArticles()
    {
        return $this->hasMany(Article::class, ['product_id' => 'id']);
    }


    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable(ProductGroupRef::tableName(), ['product_id' => 'id']);
    }


    /**
     * @return Article
     */
    public function getBrands()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getRelated()
    {
        return $this->hasMany(Related::class, ['id' => 'related_id'])->viaTable('catalog_product_related_ref', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Product::class, ['id' => 'set_id'])->viaTable('catalog_product_set_ref', ['product_id' => 'id']);
    }

    /* public function getSets()
    {
        return $this->hasMany(Set::class, ['id' => 'set_id'])->viaTable(ProductSetRef::tableName(), ['product_id' => 'id']);
    }*/

    public function getFeatures()
    {
        if (!empty($this->group_ids)) {
            $features = Feature::getObjectList(true, $model->group_ids);
        } else {
            $features = [];
        }
    }

    public static function viewPage($id)
    {
         if (is_numeric($id)) {
        $page = self::find()->where(['id' => $id])->one();
         } else {
              $page = self::find()->where(['slug' => $id])->one();
        //echo $page->id; die;  //->createCommand()->getRawSql(); die;
          }
        if ($page === null) {
            throw new \NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->view->params['page'] = $page;
        Yii::$app->view->title = $page->name;
        if ($page->text) {
            Yii::$app->view->registerMetaTag([
                'name' => 'text',
                'content' => $page->text
            ]);
        }
        /*if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->keywords
            ]);
        }*/
        return $page;
    }
}
