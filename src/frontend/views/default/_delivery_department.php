<?php

use yii\widgets\MaskedInput;

echo MaskedInput::widget([
    'id' => 'orderform-delivery',
    'name' => 'OrderForm[delivery]',
    'mask' => Yii::t('app', 'city @{3,32}, number of Nova Poshta № 9{1,4}'),
    'definitions' => [
        '@' => [
            'validator' => '[А-Яа-яA-Za-z ]',
        ],
    ],
    'options' => [
        'class' => 'form-control',
        'placeholder' => Yii::t('app', 'Enter the city and branch number of Nova Poshta'),
    ],
]);