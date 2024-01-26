<?php
namespace siripravi\ecommerce;
use app\modules\shopcart\models\Cart;
use yii\helpers\ArrayHelper;
use yz\shoppingcart\ShoppingCart;
class AfterSaveFeaturesHandler
{
    /**
     * Handles the after login event process to send emails
     *
     * @param FormEvent $event Event object form
     *
     * @return null
     */
    public static function handleAfterSave(\siripravi\ecommerce\AfterSaveFeaturesEvent $event)
    {
        $model = $event->model;
        $id = implode("+", $model->Features);
        $ftext = $model->FeatureText;
        $pid = $model->Pid;
        $price = $model->Price;
        $cart = Cart::getCart();
       
        if (isset($cart[$id])){
            return false;
        }
        $qty = isset($cart[$id]) ? $cart[$id]["qty"] + 1 : 1;
        ArrayHelper::setValue($cart, $id, ["qty" =>  $qty, "pid" => $pid, "ftext" => $ftext, "price" => $price]);
        Cart::setCart($cart);

        //** New Cart functionality with db save */
        $shopping = new ShoppingCart();       
        //if ($model) {
            $shopping->put($model, $model->Quantity);
          //  \Yii::$app->cart->create($model, $model->Quantity);
       // }       
     //   $ycart = \Yii::$app->cart;
    //    $ycart->put($model, 1);
        return true;
    }
}