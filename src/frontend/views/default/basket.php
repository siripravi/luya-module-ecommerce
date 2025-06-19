<div class="row">
    <div class="col-md-10">
        <!-- where the content of the basket and confirm layout will be returned -->
        <?= $morning; ?>
    </div>

    <div class="col-md-2">
        <h1>Basket</h1>
        <p><?= $this->context->getBasketCount(); ?> item(s)</p>
    </div>
</div>