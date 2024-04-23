<?php

namespace siripravi\ecommerce\frontend\properties;

use siripravi\ecommerce\frontend\Module;
use luya\admin\base\Property;

class SecondaryColorProperty extends Property
{
    /**
     * @inheritDoc
     */
    public function varName()
    {
        return 'secondaryColor';
    }

    /**
     * @inheritDoc
     */
    public function label()
    {
        return Module::t('Secondary Color');
    }

    /**
     * @inheritDoc
     */
    public function type()
    {
        return self::TYPE_COLOR;
    }
}
