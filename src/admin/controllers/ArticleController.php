<?php

namespace siripravi\ecommerce\admin\controllers;

/**
 * Article Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ArticleController extends \luya\admin\ngrest\base\Controller
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'siripravi\ecommerce\models\Article';

    /**
     *
     * @param unknown $id
     * @return unknown
     */

    public function actionArticleFeatures()
    {
        return $this->render('articlefeature');
    }

    public function actionArticleAttributes()
    {
        return $this->render('articleattribute');
    }
}
