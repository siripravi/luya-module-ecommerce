<?php
/* @var $this yii\web\View */
/* @var $page app\components\Category */
/* @var $categories app\components\Category[] */
/* @var $products dench\products\models\Product[] */
/* @var $searchModel dench\products\models\ProductFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $features dench\products\models\Feature[] */

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products'),
    'url' => ['/menu/' . $page->slug],
];

if ($page->parent) {
    $url_active = Url::to(['/main/category/pod', 'slug' => $page->parent->slug]);
    $this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', $page->parent->name),
        'url' => $url_active,
    ];
} else {
    $url_active = Url::to(['/catalog/category/view', 'slug' => $page->slug]);
}

$this->params['breadcrumbs'][] = $page->name;

$js = <<<JS
    $('.sidebar nav .nav-link[href="{$url_active}"]').addClass('active bg-gradient-primary text-white');
JS;
$this->registerJs($js);
?>

<?php Pjax::begin(['id' => 'pjax']); ?>
<div class="container" style="margin-top:124px;">
    <?php if ($page->text) : ?><h2 class="text-center heading"><?= $page->text ?> </h2><?php endif; ?>
    <?=
    $this->render('_search', [
        'model' => $searchModel,
        'page' => $page,
        'features' => $features
    ])
    ?>
HELLO WORLD
    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'layout' => '<div class="row featured">{items}</div>',
        'emptyTextOptions' => [
            'class' => 'alert alert-danger',
        ],
        'options' => ['class' => 'products home-products container'],
        'itemOptions' => [
            'class' => 'col-sm-6 col',
        ]
    ]);
    ?>
</div>
<?php Pjax::end(); ?>

<!--php if (!Yii::$app->request->get('page') && $page->seo): ?>
    <div class="card mb-3">
        <div class="page-seo card-body">
            <= $page->seo ?>
        </div>
    </div>
<php endif; ?-->