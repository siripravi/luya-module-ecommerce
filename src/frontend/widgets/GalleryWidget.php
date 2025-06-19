<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 17.12.17
 * Time: 19:47
 *
 * ```php
 * echo Gallery::widget([
 *     'items' => [
 *         [
 *             'image' => '',
 *             'thumb' => '',
 *             'width' => '',
 *             'height' => '',
 *             'title' => '',
 *             'caption' => '',
 *         ],
 *     ],
 * ]);
 * ```
 */

namespace siripravi\ecommerce\frontend\widgets;

use siripravi\ecommerce\frontend\assets\PhotoswipeAsset;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class GalleryWidget extends Widget
{
    public $items = [];

    public $options = ['class' => 'gallery'];

    public $selector = '.gallery-item';

    public $itemOptions = [];

    public $linkOptions = ['class' => 'gallery-item'];

    public $clientOptions = [];

    protected $clientItems;

    public function run()
    {
        $view = $this->getView();
        PhotoswipeAsset::register($view);

        $html = $this->render('pswp');

        $html .= $this->renderItems();

        $items = json_encode($this->clientItems);

        $clientOptions = json_encode($this->clientOptions);

        $js = <<<JS
var pswpElement = document.querySelectorAll('.pswp')[0];        
$(document).on('click', '{$this->selector}', function(e){
    e.preventDefault();
    var options = { index: $(this).index(), bgOpacity: 0.7, showHideOpacity: true };  
    $.merge(options, {$clientOptions});
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, {$items}, options);
    gallery.init();    
});
JS;
        $view->registerJs($js);

        echo $html;
    }

    protected function renderItems()
    {
        $items = '';

        foreach ($this->items as $item) {
            $items .= $this->renderItem($item);
        }

        return Html::tag('div', $items, $this->options);
    }

    protected function renderItem($item)
    {
        $title = !empty($item['caption']) ? $item['caption'] : null;

        $this->clientItems[] = [
            'src' => $item['image'],
            'w' => $item['width'],
            'h' => $item['height'],
            'title' => $title,
        ];

        $itemOptions = ArrayHelper::merge([
            'alt' => $title,
        ], $this->itemOptions);

        $linkOptions = ArrayHelper::merge([
            'title' => $title,
        ], $this->linkOptions);

        $img = Html::img($item['thumb'], $itemOptions);

        return Html::a($img, $item['image'], $linkOptions);
    }
}
