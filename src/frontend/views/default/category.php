<?php
use yii\widgets\LinkPager;
use luya\admin\filters\MediumCrop;

/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
?>
 <div class="row">
<?php foreach ($provider->models as $item): ?>
    <?php /** @var \luya\news\models\Article $item */ ?>
    <h2><?= $item->name; ?></h2>
   
    <?php if ($item->image_id): ?>
   
    	<div class="col-md-3">
    		<img src="<?= $item->getImage()->applyFilter(MediumCrop::identifier())->source; ?>" class="img-responsive img-rounded" />
    	</div>
    	<div class="col-md-9">
    		<?= $item->teaser_text; ?>
    	</div>
    
    <?php else: ?>
    <?= $item->teaser_text; ?>
    <?php endif; ?>
    <p style="margin-top:15px;">
        <a class="btn btn-primary" href="<?= $item->detailUrl; ?>">View All</a>
    </p>
<?php endforeach; ?>
</div>
<?= LinkPager::widget(['pagination' => $provider->pagination]); ?>
