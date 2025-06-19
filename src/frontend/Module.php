<?php
namespace siripravi\ecommerce\frontend;
use yii;
/**
 * Portfolio Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0. 
 */
class Module extends \luya\base\Module
{
    public $useAppViewPath = false;
     /**
     * @var array The default order for the article overview in the index action for the news.
     *
     * In order to read more about activeDataProvider defaultOrder: http://www.yiiframework.com/doc-2.0/yii-data-sort.html#$defaultOrder-detail
     */
    public $articleDefaultOrder = ['created_at' => SORT_DESC];
    
    /**
     * @var integer Default number of pages.
     */
    public $articleDefaultPageSize = 10;

    public static function onLoad()
    {
        Yii::setAlias('@luyathemes', static::staticBasePath());

        self::registerTranslation('luyathemes*', '@luyathemes/messages', [
            'luyathemes' => 'luyathemes.php',
        ]);

        parent::onLoad();
    }
    /**
     * @inheritdoc
     */
    public $urlRules = [
        // ['pattern' => 'gallery/kategorie/<catId:\d+>/<title:[a-zA-Z0-9\-]+>/', 'route' => ''],
        //['pattern' => 'gallery/album/<albumId:\d+>/<title:[a-zA-Z0-9\-]+>/', 'route' => ''],

        ['pattern' => 'ecommerce/page-<page:[0-9]+>', 'route' => 'ecommerce/category/index'],
        ['pattern' => 'ecommerce', 'route' => 'ecommerce/category/pod'],
        ['pattern' => 'ecommerce/<slug:[0-9a-z\-]+>/page-<page:[0-9]+>', 'route' => ''],
        ['pattern' => 'ecommerce/<slug:[0-9a-z\-]+>', 'route' => 'ecommerce/category/pod'],
        ['pattern' => 'menu/<slug:[0-9a-z\-]+>/page-<page:[0-9]+>', 'route' => 'ecommerce/category/view'],
        ['pattern' => 'menu/<slug:[0-9a-z\-]+>/page-<page:[0-9]+>', 'route' => 'ecommerce/default/index'],
        ['pattern' => 'menu/<slug:[0-9a-z\-]+>', 'route' => 'ecommerce/category/view'],
        ['pattern' => 'menu/<slug:[0-9a-z\-]+>', 'route' => 'ecommerce/default/index'],
      //  ['pattern' => 'product-detail/<slug:[0-9a-z\-]+>', 'route' => 'ecommerce/product/index'],
     // ['pattern' => 'product-detail/<slug:[0-9a-z\-]+>', 'route' => 'cart/product/index'],
        ['pattern' => 'product/<slug:[0-9a-z\-]+>', 'route' => 'ecommerce/product/index'],
        [
            'pattern' => 'my-basket',
            'route' => 'ecommerce/default/basket',
        ],
        // 'ecommerce/<id:\d+>/<title:[a-zA-Z0-9\-]+>' => 'ecommerce/default/detail',


    ];

    /**
     * @var string Default route for this module: controller/action
     */
    public $defaultRoute = 'category';

    public static function t($message, array $params = [], $language = null)
    {
        return parent::baseT('luyathemes', $message, $params, $language);
    }
}
