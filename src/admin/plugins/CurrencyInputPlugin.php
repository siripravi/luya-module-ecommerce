<?php

namespace app\modules\eshop\admin\plugins;

use luya\admin\helpers\Angular;
use luya\admin\ngrest\base\Plugin;

class CurrencyInputPlugin extends Plugin
{
    public function renderList($id, $ngModel)
    {
        $this->createListTag($ngModel);
    }

    public function renderUpdate($id, $ngModel)
    {
        return Angular::directive('currency-input', ['model' => $ngModel, 'data' => $this->getServiceName('data')]);
    }

    public function renderCreate($id, $ngModel)
    {
        return Angular::directive('currency-input', ['model' => $ngModel, 'data' => $this->getServiceName('data')]);
    }

    public function serviceData($event)
    {
        return [
            'data' => [
                // some data we always want to expose to the directive,
            ],
        ];
    }
}
