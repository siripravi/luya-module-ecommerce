<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 04.02.18
 * Time: 17:54
 */

namespace siripravi\ecommerce\frontend\widgets;

use yii\base\Widget;

class OrderScheme extends Widget
{
    public $baseUrl =  __DIR__ . "/";

    public function init()
    {
        // Tell AssetBundle where the assets files are
        // $this->sourcePath = __DIR__ . "/";
        parent::init();
    }
    public function run()
    {

        return $this->render('orderScheme', ['baseUrl' => $this->baseUrl]);
    }
}
