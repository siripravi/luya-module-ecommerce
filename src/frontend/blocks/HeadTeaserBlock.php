<?php

namespace siripravi\ecommerce\frontend\blocks;

use luya\cms\base\PhpBlock;
use siripravi\ecommerce\models\Product;
use siripravi\ecommerce\frontend\blockgroups\BlockCollectionGroup;
use yii\data\ActiveDataProvider;

/**
 * Head Teaser Block.
 *
 * File has been created with `block/create` command on LUYA version 1.0.0-RC3.
 */
class HeadTeaserBlock extends PhpBlock
{
    public $module = 'ecommerce';

    /**
     * @var boolean Choose whether block is a layout/container/segmnet/section block or not, Container elements will be optically displayed
     * in a different way for a better user experience. Container block will not display isDirty colorizing.
     */
    //  public $isContainer = true;

    /**
     * @var bool Choose whether a block can be cached trough the caching component. Be carefull with caching container blocks.
     */
    public $cacheEnabled = false;

    /**
     * @var int The cache lifetime for this block in seconds (3600 = 1 hour), only affects when cacheEnabled is true
     */
    public $cacheExpiration = 3600;

    public $product_ids = [28, 4];
    public $link;
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
        return 'Head Teaser Block';
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
            'placeholders' => [
                ['var' => 'elements', 'label' => 'Elemente', 'type' => self::TYPE_LIST_ARRAY],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function extraVars()
    {
        return [
            //  'menu' => Group::getMenu(),
            'elements' => $this->getHomeProducts()
        ];
    }

    public function getHomeProducts()
    {
        $query = Product::find();
        $query->joinWith(['groups']);
        $query->andWhere(['catalog_product.enabled' => true]);
        $query->andWhere(['catalog_product.id' => $this->product_ids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
        ]);
        //$model = Product::find()->where(['id' => $this->product_ids])->all();
        return [
            'dataProvider' => $dataProvider
        ];
    }

    /**
     * {@inheritDoc}
     *
     */
    public function admin()
    {
        return '<p>Featured Products</p>';
    }
}
