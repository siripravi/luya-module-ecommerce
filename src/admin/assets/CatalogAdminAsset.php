<?php

namespace siripravi\ecommerce\admin\assets;

use luya\web\Asset;

class CatalogAdminAsset extends Asset
{
    public $sourcePath = '@ecommerceadmin/resources';

    public $js = [
        'articleFeatures.js',
    ];

    public $depends = [
        'luya\admin\assets\Main',
    ];
}
