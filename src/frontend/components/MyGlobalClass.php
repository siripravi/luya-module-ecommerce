<?php
namespace siripravi\ecommerce\frontend\components;
class MyGlobalClass extends \yii\base\Component{
    public function init() {
        echo "Hi";
        parent::init();
    }
}