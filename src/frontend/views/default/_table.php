<?php
/* @var $this yii\web\View */
/* @var $items app\models\Variant[] */
/* @var $cart array */

use app\helpers\ImageHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$url_del = Url::to(['/bag/del']);
$url_set = Url::to(['/bag/set']);
$url_cart = Url::to(['/bag/block']);

$js = <<<JS
$('.product-delete').click(function(e){
    e.preventDefault();
    var id = $(this).attr('rel');
    $.get('{$url_del}', { id: id }, function(data){
        if (data) {
            $('#i' + id).fadeOut('normal', function(){
                $(this).remove();
                calculate();
            });
        }
    });
});
$('.product-count').keyup(function(){
    var a = $(this).attr('data-id');
    var b = $(this).val();
    $.get('{$url_set}', { id: a, count: b}, function(){
        $('.product-count[data-id="' + a + '"]').val(b);
        calculate();
    });
});
function reloadCart() {
    $.get('{$url_cart}', function(data) {
        $('#cart').after(data).remove();
    });
}
function calculate() { 
    $('.table-cart').each(function(){
        var total = 0;
        $(this).find('.product-count').each(function(){
            var sum = $(this).val() * $(this).attr('data-price');
            total += sum;
            $(this).parents('tr').find('.sum').text(sum);
        });
        $('.total').text(total);
        reloadCart();
    });
}
calculate();
JS;

//$this->registerJs($js);
?>
 <?php if ($items) : ?>
    <?= Html::button("Update Cart", ["data-bs-toggle"=>"offcanvas","data-bs-target"=>"#offcanvasCart"]);?>
    <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-3 text-center text-uppercase">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto table-responsive">
                                <form class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php foreach ($items as $k => $item) : ?>
                                            <tr>
                                                <td>
                                                <?php if (isset($item->product->image)) : ?>
                    <?= Html::a(Html::img(ImageHelper::thumb($item->product->image->id, 'micro'), ['class' => 'img-fluid']), ['product/index', 'slug' => $item->product->slug]) ?>
                    <?php endif; ?>
                    <?= Html::a($item->product->name, ['product/index', 'slug' => $item->product->slug]) ?>
                                                </td>
                                                <td>
                                                <?= $item->priceDef ?>
                                                </td>
                                                <td>
                                                <?= Html::textInput('Count[]', $cart[$item->id], ['class' => 'form-control text-center form-control-sm product-count', 'size' => 1, 'data-id' => $item->id, 'data-price' => $item->priceDef]) ?>
                                                </td>
                                                <td>
                                                    $1,500
                                                </td>
                                                <td>
                                                    <button class="btn btn-link text-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total</th>
                                                <th>$4,000</th>
                                                <th></th>
                                                <?= Yii::t('app', 'Total amount') ?>: <b><?= $items[0]->currencyDef->before . '<span class="total">0</span> ' . $items[0]->currencyDef->after ?></b>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button class="btn btn-outline-secondary me-3" type="submit">Update</button>
                                        <a href="#" class="btn btn-outline-success">Checkout</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

<?php else: ?>
<div class="alert alert-warning">
    <?= Yii::t('app', 'Cart empty') ?>
</div>
<?php endif; ?>