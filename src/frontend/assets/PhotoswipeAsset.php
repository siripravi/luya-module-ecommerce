<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 17.12.17
 * Time: 19:42
 */

namespace siripravi\ecommerce\frontend\assets;

use yii\web\AssetBundle;

class PhotoswipeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/photoswipe/dist';

    /**
     * @inheritdoc
     */
    public $js = [
        'photoswipe.min.js',
        'photoswipe-ui-default.min.js'
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'photoswipe.css',
        'default-skin/default-skin.css'
    ];

    public $depends = ['yii\web\YiiAsset'];
}
