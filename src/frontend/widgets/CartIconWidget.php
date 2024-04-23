<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 20.01.18
 * Time: 14:02
 */

namespace siripravi\ecommerce\frontend\widgets;

use siripravi\ecommerce\models\Cart;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;


class CartIconWidget extends Widget
{
    public $id = 'cart-icon';

    public $options = [];

    public $urlCart = ['/catalog/default/cart'];

    public $iconOptions = ['class' => 'fas fa-shopping-cart'];

    public $linkOptions = [];

    public function run()
    {

        $cart = Cart::getCart();

        // $this->registerClientScript();

        $options = [
            'id' => $this->id,
            'class' => 'cart-icon header-item',
            //'data-bs-toggle'=>"tooltip",
            // 'data-bs-html' => "true",
            'title' => 'You have items in cart',
            "data-bs-toggle" => "offcanvas",
            "tabindex" => "-1",
            "data-bs-target" => "#offcanvasCart",
            "aria-controls" => "offcanvasCart"
        ];

        $optionsClass = ArrayHelper::remove($this->options, 'class');

        $options = array_merge($options, $this->options);

        Html::addCssClass($options, $optionsClass);

        $count = 0;

        foreach ($cart as $c) {
            $count += $c;
        }

        /*  if ($count) {
            $count = '<span class="cart-count">' . $count . '</span>';
        } else {
            return Html::tag('span', null, $options);
        }*/
        return Html::tag("div", Html::a(
            Icon::showLayers(
                [
                    ['name' => 'shopping-cart'],
                    [
                        'text' => $count,
                        'options' =>
                        ['class' => 'fa-layers-counter', 'style' => 'background:Tomato']
                    ],
                ],
                ['style' => 'background:white']
            ),
            "#view-cart",
            $options
        ), ["class" => "header-item"]);
    }

    private function registerClientScript()
    {
        $url = Url::to(['/catalog/default/icon']);
        $js = <<<JS
        function reloadCartIcon() {
            $.get('{$url}', function(data) {
                $('#{$this->id}').after(data).remove();
            });
        }
        JS;
        //$this->view->registerJs($js);
    }
}
