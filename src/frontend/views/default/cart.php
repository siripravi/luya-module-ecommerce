<?php
/* @var $this yii\web\View */
/* @var $page common\modules\page\models\Page */
/* @var $items app\models\Variant[] */
/* @var $cart array */
/* @var $model common\modules\shopcart\models\OrderForm */
/* @var $notAvailable boolean */

use app\modules\shopcart\models\Delivery;
use app\modules\shopcart\models\Payment;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->params['breadcrumbs'][] = "";

$delivery_url = Url::to(['cart/delivery']);
$payment_url = Url::to(['cart/payment']);

$js = <<<JS
$('#delivery_id').change(function(){
    var iD = $(this).find(':checked').val();
    $('#delivery-info').load('{$delivery_url}', { id: iD });
});
$('#payment_id').change(function(){
    var iD = $(this).find(':checked').val();
    $('#payment-info').load('{$payment_url}', { id: iD });
});
JS;

$this->registerJs($js);

$css = <<<CSS
.control-label {
    font-weight: bold;
}
.help-block {
    font-size: 13px;
    margin-top: 5px;
}
.help-block-error {
    color: red;
}
CSS;

$this->registerCss($css);
?>
<h1 class="mb-3"><?= "Shopping Cart" ?></h1>


<?= $this->render('_table', [
    'items' => $items,
    'cart' => $cart,
]) ?>

<?php if ($items) : ?>

    <?php $form = ActiveForm::begin(['options' => ['class' => 'mt-3']]) ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white"><?= Yii::t('app', 'Required information for ordering') ?></div>
            <div class="card-body">
                <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Full name')]) ?>

                <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                    'mask' => '+91 (99999-99999)',
                ]) ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <?= $form->field($model, 'entity')->radioList([
                    0 => Yii::t('app', 'Private person'),
                    1 => Yii::t('app', 'Organization'),
                ], ['class' => 'pt-2']) ?>

                <?= $form->field($model, 'comment')->textarea() ?>

                <?php if (!YII_DEBUG): ?>
                    <!--?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::class)->label(false) ?-->
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white"><?= Yii::t('app', 'Delivery method') ?></div>
            <div class="card-body">
                <?= $form->field($model, 'delivery_id')->radioList(Delivery::getList(), [
                    'class' => 'pt-2',
                    'id' => 'delivery_id',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="radio"><label>' . Html::radio($name, $checked, ['value' => $value]) . ' '. $label . '</label></div>';
                    },
                ]) ?>
                <div id="delivery-info"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-secondary text-white"><?= Yii::t('app', 'Payment method') ?></div>
            <div class="card-body">
                <?= $form->field($model, 'payment_id')->radioList(Payment::getList(), [
                    'class' => 'pt-2',
                    'id' => 'payment_id',
                    'item' =>  function ($index, $label, $name, $checked, $value) use ($notAvailable) {
                        $disabled = $value === 2 && $notAvailable;
                        $options = array_merge([
                            'label' => Html::encode($label),
                            'value' => $value,
                            'disabled' => $disabled,
                        ]);
                        return '<div class="radio' . ($disabled ? ' text-muted' : null) . '">' . Html::radio($name, $checked, $options) . '</div>';
                    },
                ]) ?>
                <div id="payment-info"></div>
            </div>
        </div>
    </div>
</div>


    <div class="text-muted">
        <b style="color: red;">*</b> <?= Yii::t('app', ' - fields are required') ?>
    </div>

    <div class="text-center mt-4">
        <?= Html::submitButton(Yii::t('app', 'To order'), ['id' => 'submitButton', 'class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end() ?>

<?php endif; ?>

