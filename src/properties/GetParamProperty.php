<?php

namespace siripravi\ecommerce\properties;

use Yii;
use yii\helpers\Json;
use luya\admin\base\Property;

/**
 * The Property where you can choose the groups who can see the menu item.
 *
 * @author Basil Suter <basil@nadar.io>
 */
class GetParamProperty extends Property
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // parent initializer
        parent::init();
        // atache before render to stop render if not in group
        $this->on(self::EVENT_BEFORE_RENDER, [$this, 'eventBeforeRender']);
    }
    
    public function eventBeforeRender($event)
    {
        $session = Yii::$app->session;
        if(empty($session['__params'])){
           $session['__params'] = Yii::$app->request->queryParams;
        }
        $event->isValid = false;       
    }
    
    public function varName()
    {
        return 'Request';
    }
    
    public function label()
    {
        return 'Save Request';
    }

    public function type()
    {
        return self::TYPE_TEXT;
    }
    
    public function getValue()
    {
        $value = parent::getValue();
        $session = Yii::$app->session;
        return $session['__params']['id'];  //Json::decode($value);
    }
}