<?php

namespace siripravi\ecommerce\frontend\blocks;

use yii;
use luya\cms\base\PhpBlock;
use siripravi\ecommerce\frontend\blockgroups\BlockCollectionGroup;
use luya\cms\helpers\BlockHelper;
use siripravi\ecommerce\models\Product;
use siripravi\ecommerce\models\Article;
use luya\cms\injectors\ActiveQueryCheckboxInjector;
use yii\data\ActiveDataProvider;

/**
 * Portfolio Block.
 *
 * File has been created with `block/create` command on LUYA version 1.0.0. 
 */
class RelatedGroupBlock extends PhpBlock
{
    // public $isContainer = true;

    /**
     * @var string The module where this block belongs to in order to find the view files.
     */
    public $module = 'ecommerce';

    /**
     * @var bool Choose whether a block can be cached trough the caching component. Be carefull with caching container blocks.
     */
    public $cacheEnabled = true;

    /**
     * @var int The cache lifetime for this block in seconds (3600 = 1 hour), only affects when cacheEnabled is true
     */
    public $cacheExpiration = 3600;

    /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return BlockCollectionGroup::class;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return 'Related Products';
    }

    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'local_mall'; // see the list of icons on: https://design.google.com/icons/
    }

    /**
     * @inheritDoc
     */
    public function config()
    {
        return [
            'cfgs' => [
                ['var' => 'images', 'label' => 'Images', 'type' => self::TYPE_IMAGEUPLOAD_ARRAY, 'options' => ['no_filter' => false]],
                ['var' => 'client_name', 'label' => 'Client Name', 'type' => self::TYPE_TEXT],
                ['var' => 'profession', 'label' => 'Profession', 'type' => self::TYPE_TEXT],
                ['var' => 'review', 'label' => 'The Text', 'type' => self::TYPE_TEXTAREA],
                ['var' => 'sel', 'label' => 'Selected', 'type' => self::TYPE_TEXT],
            ],
            /* 'placeholders' => [
                [
                    ['var' => 'left', 'cols' => 8, 'label' => 'Left'],
                    ['var' => 'right', 'cols' => 4, 'label' => 'Right'],
                ]
            ],*/
        ];
    }

    /**
     * @inheritDoc
     */
    public function extraVars()
    {
        return [
            'images' => BlockHelper::imageArrayUpload($this->getCfgValue('images'), false, true),
            'txtClient' =>  $this->getVarValue('client_name'),
            'tarReview' => $this->getVarValue('mytext'),
            'elements' => $this->getRelatedProds()
        ];
    }

    /**
     * {@inheritDoc} 
     *
     * @param {{vars.elements}}
     */
    public function admin()
    {
        return '<h5 class="mb-3">Reviews</h5>' .
            '<table class="table table-bordered">' .
            '{% if cfgs.images is not empty %}' .
            '<tr><td><b>Clients</b></td><td>{{cfgs.images}}</td></tr>' .
            '{% endif %}' .
            '</table>';
    }

    /**
     * {@inheritdoc}
     */
    /* public function getViewPath()
    {
        return  dirname(__DIR__).'/src/views/blocks';
    }  */

    public function XSinjectors()
    {
        $slug = (isset(Yii::$app->request->queryParams['slug'])) ? Yii::$app->request->queryParams['slug'] : 4;
        //echo $slug;
        $id = (isset(Yii::$app->request->queryParams['id'])) ? Yii::$app->request->queryParams['id'] : 4;

        $model = ($id) ? Product::viewPage($id) : $id;
        //print_r($model->group_ids); die;
        $query = Product::ngRestFind();
        $query->joinWith(['groups']);
        $query->andWhere(['catalog_product.enabled' => true]);
        $query->andWhere(['catalog_product.id' => [1]]);
        /*$query = (new \yii\db\Query())
        ->select(['catalog_product.*'])
        ->from('catalog_product')
        ->leftJoin('catalog_product_group_ref','catalog_product.id = catalog_product_group_ref.product_id')
        ->leftJoin('catalog_group' , 'catalog_product_group_ref.group_id = catalog_group.id')
        -> where(['catalog_product.enabled'=>1, 'group_id'=>1,['catalog.product.id' => $model->group_ids[0]])
        ->andWhere(['!=','catalog_product.id', $model->id])
        ->limit(6)*/
        //Product::find()->joinWith(['groups'])->where(['catalog_product.enabled' => 1, 'group_id' => [1]])->andWhere(['!=', 'catalog_product.id', $model->id])->limit(6);
        return [
            'related' => new ActiveQueryCheckboxInjector([
                'query' => $query, //->joinWith('related'),
                'type' => self::INJECTOR_VAR, // could be self::INJECTOR_CFG,
                'varName' => 'id',
                'varLabel' => 'The Field Label',
            ])
        ];
    }

    public function getRelatedProds()
    {
        $dataProvider = [];
       // $slug = (isset(Yii::$app->request->queryParams['id'])) ? Yii::$app->request->queryParams['id'] : 4;
        $slug = \Yii::$app->request->get('id') ?  \Yii::$app->request->get('id'):6; 
        $model = ($slug) ? Article::findOne(['id' => $slug, 'enabled' => 1]) : 7; //; //Product::viewPage($slug)
        $product = Product::viewPage($model->product_id);
        $similar = Product::find()->joinWith(['groups','articles'])->where(['catalog_product.enabled' => 1, 'group_id' => $product->group_ids])->andWhere(['!=', 'catalog_product.id',  $product->id])->limit(6)->all();
   
        if ($similar) { //echo "<pre>";
            //print_r($model->related_ids);
          //  $query = Product::find()->joinWith(['groups'])->where(['catalog_product.enabled' => 1, 'group_id' => $model->related_ids[0]])->andWhere(['!=', 'catalog_product.id', $model->id])->limit(6);
         /*   $dataProvider = new ActiveDataProvider([
                'query' => $similar,
                'sort' => [
                    'defaultOrder' => [
                        'position' => SORT_DESC,
                    ],
                ],
                'pagination' => [
                    'forcePageParam' => false,
                    'pageSizeParam' => false,
                    'pageSize' => 12,
                ],
            ]);  */
            
        }
        //$model = Product::find()->where(['id' => $this->product_ids])->all();
        return [
            'similar' => $similar
        ];
        /*$query = Product::find();
        $query->joinWith(['groups']);
        $query->andWhere(['catalog_product.enabled' => true]);
        $query->andWhere(['catalog_product.id' => $this->product_ids]);
        $dataProvider = new ActiveDataProvider([
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
        ]);  
		//$model = Product::find()->where(['id' => $this->product_ids])->all();
	 return [
        'dataProvider' => $dataProvider
    ];
    (new \yii\db\Query())
    ->select(['catalog_product.*'])
    ->from('catalog_product')
    ->leftJoin('catalog_product_group_ref','catalog_product.id' = 'catalog_product_group_ref.product_id')
    ->leftJoin('catalog_group' , 'catalog_product_group_ref.group_id = 'catalog_group.id')
    -> where(['catalog_product.enabled'=>1, 'group_id'=>1,'catalog.product.id, 'group_id' => $model->group_ids[0]])
    ->andWhere(['!=','catalog_product.id', $model->id])
    ->limit(6)

    SELECT `catalog_product`.* FROM `catalog_product` LEFT JOIN `catalog_product_group_ref` ON `catalog_product`.`id` = `catalog_product_group_ref`.`product_id` LEFT JOIN `catalog_group` ON `catalog_product_group_ref`.`group_id` = `catalog_group`.`id` WHERE ((`catalog_product`.`enabled`=1) AND (`group_id`='1')) AND (`catalog_product`.`id` != 4) AND (`id` IN (1, 4, 2)) ORDER BY `catalog_group`.`position` LIMIT 6
    */
    }
}
