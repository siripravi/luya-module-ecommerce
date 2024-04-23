<?php

namespace siripravi\ecommerce\frontend\blocks;

use siripravi\ecommerce\models\Group;
use siripravi\ecommerce\models\Article;
use luya\cms\base\PhpBlock;
use siripravi\ecommerce\frontend\blockgroups\BlockCollectionGroup;

/**
 * Portfolio Block.
 *
 * File has been created with `block/create` command on LUYA version 1.0.0. 
 */
class CategoryBlock extends PhpBlock
{
    /**
     * @var string The module where this block belongs to in order to find the view files.
     */
    public $module = 'ecommerce';

    /**
     * @var bool Choose whether a block can be cached trough the caching component. Be carefull with caching container blocks.
     */
    public $cacheEnabled = true;

    /**
     * @var int The cache lifetime for this block in seconds (3600 = 1 hour), only affects when cacheEnabled is true
     */
    public $cacheExpiration = 3600;

    /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return BlockCollectionGroup::class;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return 'Group Listing';
    }

    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'local_mall'; // see the list of icons on: https://design.google.com/icons/
    }

    /**
     * @inheritDoc
     */
    public function config()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function extraVars()
    {
        return [
            'menu' => Group::getMenu(),
            'elements' => Group::getElements()
        ];
    }

    /**
     * {@inheritDoc} 
     *
     * @param {{vars.elements}}
     */
    public function admin()
    {
        return '<h5 class="mb-3">Group Block</h5>';
    }

    /**
     * {@inheritdoc}
     */
    /* public function getViewPath()
    {
        return  dirname(__DIR__).'/src/views/blocks';
    }  */
}
