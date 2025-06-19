<?php
/**
 * @var $model \dench\shopcart\models\Delivery
 */

use dench\shopcart\models\Delivery;

echo $model->text;

if ($model->type === Delivery::TYPE_ADDRESS) {
    echo $this->render('_delivery_address');
} elseif ($model->type === Delivery::TYPE_DEPARTMENT) {
    echo $this->render('_delivery_department');
}