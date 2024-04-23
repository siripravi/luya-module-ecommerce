
<div class="container py-5">
    <div class="row">
        <div class="col px-4 text-center">
            <img src="http://via.placeholder.com/640x360" class="img-fluid" alt="Product Image" />
        </div>
        <div class="col">
            <h1 class="fw-bold"><?= $article->name; ?></h1>
            <p class="text-muted">Product Category</p>
            <div style="padding-right: 0;">
                <span style="vertical-align:super;font-size:31px; padding-right:5px;" class="moneySymbol">₹</span>
                <span class="product-price moneyCal" data-inr="<?= $article->price; ?>" style="color: #fff; font-size: 48px; font-weight: 600;" id="productPrice"><?= $article->price; ?></span>
            </div>
            <?php Pjax::begin(['id' => 'feature-pjax']); ?>
            <?php if (empty($features)) : ?>
                <?= Html::tag('div', Yii::t('app', 'Select a category!'), ['class' => 'alert alert-danger']) ?>
            <?php else :    ?>
                <?php foreach ($features as $id => $feature) {
                    $priceList = $article->getPricesDef($feature->id);
                    echo "<h5>" . $feature->name . "</h5>";
                    echo "<div class='featSel'>";
                    echo "<div class='d-flex flex-wrap align-content-start'>";
                    echo Html::radioList(
                        'buy[' . $article->product_id . '][' . $feature->id . ']',
                        "",
                        ArrayHelper::map($priceList, "price", "ftext"),
                        [
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $checked = ($index == 0 && $value > 0) ? 'checked' : '';
                                $return = '<div class="p-2 flex-fill fsel ' . $checked . '">';
                                $return .= '<input type="radio" id="' . $name . $index . '" class="btn-check" data-ftext="' . $label . '" name="' . $name . '" value="' . $value . '" title="click" autocomplete="off" ' . $checked . '>';
                                $return .= '<label class="btn btn-outline-success" for="' . $name . $index . '">' . '<i class="bi bi-circle pe-2" style="font-size:20px;"></i><span class="xtext-muted">' . ucwords($label) . '</span></label>';
                                $return .= "</div>";
                                return $return;
                            },
                            'class' => 'd-flex text-inline'
                        ]
                    );
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            <?php endif; ?>
            <?php Pjax::end(); ?>
            <div class=" mb-4">
                <?php if ($article->available !== 0) : ?>
                    <form id="cart-form" action="<?= Url::to('/shopping-cart'); ?>">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" data-key="" data-ftext="" data-product="<?= $article->id; ?>" data-price="<?= $article->price; ?>" data-bs-target="#offcanvasCart" data-bs-toggle="offcanvas" class="btn btn-bd-primary btn-buy" rel="price<?= $article->id ?>">
                                <?= Yii::t('app', 'Buy This Now') ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <button class="btn btn-outline-secondary btn-sm" type="button">
                Add to Wishlist
            </button>
            <button class="btn btn-outline-secondary btn-sm" type="button">
                Compare
            </button>
        </div>
    </div>
</div>

<?php
    $js = <<<JS
            $.ajax({                
                method: "GET",
                url: "{$url}",
                dataType: "html"
                }).done(function(data) {
                    console.log(data);
               $('.time').append(data);            
            });       
        JS;
    $this->registerJs($js);
?>