<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use yii\behaviors\TimestampBehavior;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use yii\db\Expression;
use luya\admin\traits\SortableTrait;
use luya\helpers\ArrayHelper;

use app\components\Category;
use app\components\Page;

/**
 * Group.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $slug
 * @property integer $cover_image_id
 * @property text $images_list
 * @property string $teaser
 * @property text $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property tinyint $main
 * @property integer $position
 * @property tinyint $enabled
 */
class Group extends NgRestModel
{
    use SortableTrait;
    public $adminFeatures = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_group';
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
        ];
    }

    /**
     * @return string
     */
    public static function sortableField()
    {
        return 'position';
    }
    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-group';
    }

    public function extraFields()
    {
        return ['adminFeatures'];  //adminSets
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name'      => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'cover_image_id' => Yii::t('app', 'Cover Image ID'),
            // 'images_list' => Yii::t('app', 'Images List'),
            'teaser' => Yii::t('app', 'Teaser'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'main' => Yii::t('app', 'Main'),
            'position' => Yii::t('app', 'Position'),
            'enabled' => Yii::t('app', 'Enabled'),
            'adminFeatures'  => 'Features'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'cover_image_id', 'created_at', 'updated_at', 'main', 'position', 'enabled'], 'integer'],
            [['slug'], 'required'],
            [['text', 'name'], 'string'],
            [['slug', 'teaser'], 'string', 'max' => 255],
            [['adminFeatures'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            // 'parent_id' => ['selectArray', 'data' =>  self::getList(1)], // [1 => 'Male', 2 => 'Female']
            'parent_id' => ['selectModel', 'modelClass' => Group::class, 'valueField' => 'id', 'labelField' => 'name'],
            'name'      => 'text',
            'slug' => 'text',
            'cover_image_id' => 'image',
            //'images_list' => 'imageArray',
            'teaser' => 'text',
            'text' => 'textarea',
            'created_at' => 'number',
            'updated_at' => 'number',
            'main' => 'number',
            'position' => 'number',
            'enabled' => ['toggleStatus', 'initValue' => 0],
        ];
    }

    /*public function ngRestRelations()
    {
        return [
           ['label' => 'Features', 'targetModel' => FeatureGroupRef::class,'apiEndpoint' => FeatureGroupRef::ngRestApiEndpoint(), 'dataProvider' => $this->getFeatures()],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name', 'parent_id', 'cover_image_id', 'teaser', 'text', 'created_at', 'updated_at', 'main', 'position', 'enabled']],
            [['create', 'update'], ['name', 'parent_id', 'slug', 'cover_image_id',  'teaser', 'text', 'main', 'position', 'adminFeatures', 'enabled']],
            //  ['create',['parent_id']],
            ['delete', false],
        ];
    }

    public function ngRestRelations()
    {
        return [
            ['label' => 'Features', 'targetModel' => FeatureGroupRef::class, 'apiEndpoint' => FeatureGroupRef::ngRestApiEndpoint(), 'dataProvider' => $this->getFeatureGroups()],

        ];
    }

    public function getFeatureGroups()
    {
        return $this->hasMany(FeatureGroupRef::class, ['group_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    public function getFeatures()
    {
        return $this->hasMany(Feature::class, ['id' => 'feature_id'])->viaTable('catalog_feature_group_ref', ['group_id' => 'id']);
    }

    public function ngRestExtraAttributeTypes()
    {
        return [
            'adminFeatures' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getFeatures(),
                'labelField' => ['name'],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getMenu()
    {
        return ArrayHelper::map(self::find()->where(['enabled' => 1])->all(), 'id', 'group_name');
    }

    /**
     * @return \yii\db\ActiveQuery[]
     */
    public static function getMain()
    {
        return self::find()->where(['enabled' => true, 'main' => true])->orderBy(['position' => SORT_ASC])->all();
    }

    public static function viewPage($id)
    {
        if (is_numeric($id)) {
            $page = self::findOne($id);
        } else {
            $page = self::findOne(['slug' => $id]);
        }
        if ($page === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->view->params['page'] = $page;
        Yii::$app->view->title = $page->name;
        if ($page->text) {
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $page->text
            ]);
        }
        /*  if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->keywords
            ]);
        }*/
        return $page;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Group::class, ['parent_id' => 'id']);
    }

    public static function getList($enabled)
    {
        return ArrayHelper::map(self::find()->andFilterWhere(['enabled' => $enabled])->orderBy('position')->all(), 'id', 'name');
    }


    public static function getElements()
    {
        $categories = Group::getMain(); // !Yii::$app->cache->exists('_categories-' . Yii::$app->language) ? Group::getMain() : [];
        //$categories = Group::getMain();
        $query = Product::find();
        $query->joinWith(['groups']);
        $query->andWhere(['catalog_product.enabled' => true]);
        $query->andWhere(['catalog_group.enabled' => true]);
        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'position' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 12,
            ],
        ]);*/
        return [
            'categories' => $categories,
            // 'dataProvider' => $dataProvider
        ];
    }
}
