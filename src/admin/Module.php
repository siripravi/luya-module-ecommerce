<?php

namespace siripravi\ecommerce\admin;

/**
 * Catalog Admin Module.
 *
 * File has been created with `module/create` command. 
 * 
 * @author
 * @since 1.0.0
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-catalog-group'         => 'siripravi\ecommerce\admin\apis\GroupController',
        'api-catalog-product'       => 'siripravi\ecommerce\admin\apis\ProductController',
        'api-catalog-set'           => 'siripravi\ecommerce\admin\apis\SetController',
        'api-catalog-featuregroupref' => 'siripravi\ecommerce\admin\apis\FeatureGroupRefController',
        //'api-catalog-articlevalueref'  => 'siripravi\ecommerce\admin\apis\ArticleValueRefController',
        'api-catalog-article'       => 'siripravi\ecommerce\admin\apis\ArticleController',
        'api-catalog-feature'          => 'siripravi\ecommerce\admin\apis\FeatureController',
        'api-catalog-brand'         => 'siripravi\ecommerce\admin\apis\BrandController',
        'api-catalog-currency'      => 'siripravi\ecommerce\admin\apis\CurrencyController',
        'api-catalog-unit'          => 'siripravi\ecommerce\admin\apis\UnitController',
        'api-catalog-producer'      => 'siripravi\ecommerce\admin\apis\ProducerController',
        'api-catalog-productrelated' => 'siripravi\ecommerce\admin\apis\ProductRelatedController',
        'api-catalog-related'       => 'siripravi\ecommerce\admin\apis\RelatedController',
        'api-catalog-articleprice'     => 'siripravi\ecommerce\admin\apis\ArticlePriceController',
        'api-catalog-value'     => 'siripravi\ecommerce\admin\apis\ValueController',

    ];

    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node('Shop Catalog', 'local_mall')
            ->group('Products')
            ->itemApi('Groups', 'catalogadmin/group/index', 'folder', 'api-catalog-group')
            ->itemApi('Group Features', 'catalogadmin/feature-group-ref/index', 'library_books', 'api-catalog-featuregroupref')
            ->itemApi('Products', 'catalogadmin/product/index', 'library_books', 'api-catalog-product')
            ->itemApi('Articles', 'catalogadmin/article/index', 'list', 'api-catalog-article')
            ->itemApi('Related', 'catalogadmin/related/index', 'domain', 'api-catalog-related')
            ->itemApi('Prices', 'catalogadmin/article-price/index', 'adjust', 'api-catalog-articleprice')
            ->group('Settings')
            ->itemApi('Units', 'catalogadmin/unit/index', 'domain', 'api-catalog-unit')
            ->itemApi('Currencies', 'catalogadmin/currency/index', 'attach_money', 'api-catalog-currency')
            ->itemApi('Brands', 'catalogadmin/brand/index', 'auto_awesome_motion', 'api-catalog-brand')
            ->group('Sets')
            // ->itemApi('Sets', 'catalogadmin/article-value-ref/index', 'web_asset', 'api-articlevalueref')
            ->itemApi('Features', 'catalogadmin/feature/index', 'check_box', 'api-catalog-feature')
            ->itemApi('Values', 'catalogadmin/value/index', 'check_box', 'api-catalog-value');
    }

    public function getAdminAssets()
    {
        return [
            'siripravi\ecommerce\admin\assets\CatalogAdminAsset'
        ];
    }
}
