<?php

use yii\helpers\Url;
use yii\widgets\ListView;

use common\modules\image\helpers\ImageHelper;
?>
<?php
echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_item',
	'layout' => '<div class="row products_row">{items}</div>',
	'emptyTextOptions' => [
		'class' => 'alert alert-danger',
	],
	/*'options' => [
            'class' => 'list-group mb-4',
        ],*/
	'itemOptions' => [
		'class' => 'col-xl-4 col-md-6',
	],
]);


$images = [];
foreach ($model->variants as $variant) {
	foreach ($variant->images as $image) {
		$images[] = $image;
	}
}
$items = [];
foreach ($images as $photo) {
	$items[] = [
		'image' => ImageHelper::thumb($photo->id, 'big'),
		'thumb' => ImageHelper::thumb($photo->id, 'micro'),
		'width' => Yii::$app->params['image']['size']['big']['width'],
		'height' => Yii::$app->params['image']['size']['big']['height'],
		'title' => $photo->alt,
	];
}

?>