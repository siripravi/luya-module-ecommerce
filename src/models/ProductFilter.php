<?php
namespace siripravi\ecommerce\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * ProductFilter represents the model behind the search form about `admin\products\models\Product`.
 */
class ProductFilter extends \siripravi\ecommerce\frontend\components\Product
{
    public $category_id;
    public $feature_ids = [];
    public $product_ids = [];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_ids'], 'each', 'rule' => ['each', 'rule' => ['integer']]],
            [['product_ids'], 'each', 'rule' => ['integer']],
            [['name', 'category_id'], 'safe'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();
        $query->joinWith(['groups']);
        // add conditions that should always apply here
        $this->load($params);
        if ($this->feature_ids) {
            foreach ($this->feature_ids as $feature_id => $value_ids) {
                if ($value_ids) {
                    $variant_ids[$feature_id] = (new Query())->from('catalog_article_value_ref')->andFilterWhere(['value_id' => $value_ids])->column();
                }
            }
            if (isset($variant_ids)) {
                $this->product_ids = [0];
                if (count($variant_ids) > 1) {
                    $variant_ids = call_user_func_array('array_intersect', $variant_ids);
                } else {
                    $variant_ids = current($variant_ids);
                }
                if (!empty($variant_ids)) {
                    $this->product_ids = (new Query())->from('catalog_article')->select('product_id')->where(['id' => $variant_ids])->groupBy('product_id')->column();
                }
            }
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'catalog_product.id' => $this->product_ids,
            'group_id' => $this->category_id,
            'catalog_product.enabled' => $this->enabled,
        ]);

        //$query->andFilterWhere(['like', 'slug', $this->slug]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'position' => SORT_DESC,
                ],
            ],
        ]);

        return $dataProvider;
    }

    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable(ProductGroupRef::tableName(), ['product_id' => 'id']);
    }
}
