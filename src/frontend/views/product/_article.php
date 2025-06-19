<?php


?>
<div class="row">
    <!--?php foreach ($modelsVariant as $index => $modelVariant) : ?-->
    <div class="col-sm-5 col-md-6 thumb hide-on-320" data-position="<?= $modelVariant->position ?>" data-key="<?= $modelVariant->id ?>">
        <div class="photo">
            <?php if ($modelVariant->image_id) { ?>
                <a class="gallery-item" href="<?= Yii::$app->storage->getImage($modelVariant->image_id)->source ?>" data-size="500X400">
                    <img class="img-fluid" src="<?= Yii::$app->storage->getImage($modelVariant->image_id)->source; ?>" alt="<?= $modelVariant->name ?>" title="<?= $modelVariant->name ?>">
                </a>
            <?php } else { ?>
                <div class="thumbnail">
                    <img class="img-fluid" src="/img/photo-default.png" alt="photo-default">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-7 col-md-6 detail">
        <?= $this->render('_text', [
            'name' => $modelVariant->name,
            'text' => $modelVariant->text,
        ]) ?>

        <?= $this->render('_price', [
            'model' => $modelVariant,
            'features' => $features
            // 'rating' => $rating
        ]) ?>

    </div>
</div>