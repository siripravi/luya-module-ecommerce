<?php

namespace siripravi\ecommerce\frontend\properties;

use siripravi\ecommerce\frontend\Module;
use luya\admin\base\ImageProperty;

class MainImageProperty extends ImageProperty
{
    /**
     * @inheritDoc
     */
    public function varName()
    {
        return 'mainImage';
    }

    /**
     * @inheritDoc
     */
    public function label()
    {
        return Module::t('Main Image');
    }
}
