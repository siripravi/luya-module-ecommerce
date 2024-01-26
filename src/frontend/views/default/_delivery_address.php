<?php

use yii\widgets\MaskedInput;

echo MaskedInput::widget([
    'id' => 'orderform-delivery',
    'name' => 'OrderForm[delivery]',
    'mask' => Yii::t('app', 'city @{3,32}, street @{3,32}, house &{1,10}'),
    'definitions' => [
        '@' => [
            'validator' => '[А-Яа-яA-Za-z ]',
        ],
        '&' => [
            'validator' => '[0-9/]',
        ],
    ],
    'options' => [
        'class' => 'form-control',
        'placeholder' => Yii::t('app', 'Enter the city and shipping address'),
    ],
]);