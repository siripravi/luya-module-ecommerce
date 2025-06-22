<?php

namespace siripravi\ecommerce\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use siripravi\ecommerce\admin\behaviors\ManyToManyBehavior;
use yii\helpers\ArrayHelper;
/**
 * Feature.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 * @property tinyint $enabled
 */
class Feature extends NgRestModel
{

    public $adminGroups = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_feature';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
           
            [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'article_ids' => ['articles'],
                    'group_ids' => ['groups'],
                    'filter_ids' => ['filters'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-catalog-feature';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'position' => Yii::t('app', 'Position'),
            'enabled' => Yii::t('app', 'Enabled'),
            'adminGroups' => 'Categories',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'enabled'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['adminGroups'], 'safe'],
            [['group_ids'], 'each', 'rule' => ['integer']],
            [['article_ids'], 'each', 'rule' => ['integer']],
            [['filter_ids'], 'each', 'rule' => ['integer']]
        ];
    }

    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable('catalog_feature_group_ref', ['feature_id' => 'id']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::class, ['feature_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        // TODO: value_id != feature_id
        return $this->hasMany(Article::class, ['id' => 'article_id'])->viaTable('catalog_article_value_ref', ['value_id' => 'id']);
    }

    public function getFeatureValues()
    {
        $data = [];
        foreach ($this->getValues()->all() as $value) {
            $data[$value->feature_id][$value->id] = $value;
        }
        
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'name' => 'text',
            'position' => 'number',
            'enabled' => 'number',
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
       ];
    }

    public function extraFields()
    {
        return ['adminGroups'];  //adminSets
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name', 'position', 'enabled']],
            [['create', 'update'], ['name', 'adminGroups','position', 'enabled']],
            ['delete', false],
        ];
    }

   /* public function ngRestRelations()
    {
        return [
           ['label' => 'Categories', 'targetModel' => FeatureGroupRef::class,'apiEndpoint' => FeatureGroupRef::ngRestApiEndpoint(), 'dataProvider' => $this->getGroups()],
        ];
    }*/

    /**
     * @param boolean|null $enabled
     * @param array $category_ids
     * @return array
     */
    public static function getList($enabled, $category_ids)
    {
        return ArrayHelper::map(self::find()->joinWith(['groups'])->andFilterWhere(['catalog_feature.enabled' => $enabled])->andFilterWhere(['group_id' => $category_ids])->orderBy('position')->all(), 'id', 'name');
    }

    /**
     * @param boolean|null $enabled
     * @param array $category_ids
     * @return @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function getObjectList($enabled, array $category_ids)
    {
        return self::find()->joinWith(['groups'])->andFilterWhere(['catalog_feature.enabled' => $enabled])->andFilterWhere(['group_id' => $category_ids])->orderBy('position')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilters()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable('catalog_feature_filter', ['feature_id' => 'id']);
    }

     /**
     * @param boolean|null $enabled
     * @param array $category_ids
     * @return @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function getFilterList($enabled, array $category_ids)
    {
        return self::find()->joinWith(['filters'])->andFilterWhere(['catalog_feature.enabled' => $enabled])->andFilterWhere(['group_id' => $category_ids])->orderBy('position')->all();
    }



}
