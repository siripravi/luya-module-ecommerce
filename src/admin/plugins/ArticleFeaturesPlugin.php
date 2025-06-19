<?php

namespace siripravi\ecommerce\admin\plugins;

use luya\admin\ngrest\base\Plugin;

class ArticleFeaturesPlugin extends Plugin
{
    public function renderList($id, $ngModel)
    {
        return $this->createListTag($ngModel);
    }

    public function renderCreate($id, $ngModel)
    {
        return $this->createFormTag('article-features', $id, $ngModel, ['article' => 'data.create.id']);
    }

    public function renderUpdate($id, $ngModel)
    {
        return $this->createFormTag('article-features', $id, $ngModel, ['article' => 'data.update.id']);
    }
}
