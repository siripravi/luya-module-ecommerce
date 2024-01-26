<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 20.01.18
 * Time: 13:01
 */

namespace siripravi\ecommerce\frontend\widgets;

use siripravi\ecommerce\models\Article;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

class PriceTable extends Widget
{
    public $id;

    public $article;

    public $urlCartAdd = ['/cart/bag/add'];

    public $options = [];

    public $originalPrice = false;

    public $available;

    public $value_ids;
    public $list;
    public $feature_id;
    public $feature_name;

    public $features;
    public function run()
    {
        $this->registerClientScript();

        foreach ($this->features as $id => $feature) {
            $priceList = $this->article->getPricesDef($feature->id);            
            echo "<h5>" . $feature->name . "</h5>";
            echo "<div class='card card-outline featSel p-4'>";
            echo yii\bootstrap5\Html::radioList(
                'buy[' . $this->article->product_id . '][' . $feature->id . ']',
                "",
                ArrayHelper::map($priceList[$feature->id], "price", "priceLabel"),
                [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $checked = ($index == 0 && $value > 0)? 'checked':'';
                        $return = '<div class="col-3 fsel '.$checked.'">';
                        $return .= '<input type="radio" id="' . $name . $index . '" class="btn-check" name="' . $name . '" value="' . $value . '"  title="click" autocomplete="off" '.$checked.'>';
                        $return .= '<label class="btn btn-outline-warning" for="' . $name . $index . '">' . '<i class="bi bi-circle pe-2" style="font-size:34px;"></i>' . ucwords($label) . '</label>';
                        $return .= "</div>";
                        return $return;
                    },
                    'class' => 'row text-inline'
                ]
            );
            echo "</div>";
        }
    }

    private function registerClientScript()
    {
        $url_add = Url::to($this->urlCartAdd);
        $url_cart_modal = Url::to(['/cart/bag/offcanvas']);
        $js = <<< JS
          
            $('.featSel').find('input[type=radio]').change(function() {     
                var price = 0;           
                $('.featSel').find("input[type='radio']:checked").each(function(index){                   
                            var newVal = parseFloat($(this).val());
                            price += newVal; 
                        }); 
                        console.log("price",price);
                        $('.moneyCal').html(price);     
            });
                                                      
        JS;
      //  $this->view->registerJs($js, View::POS_READY, 'jsPriceTable');
    }
}