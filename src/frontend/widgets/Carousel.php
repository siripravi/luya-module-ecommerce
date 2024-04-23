<?php

namespace siripravi\ecommerce\frontend\widgets;

use Yii;
use yii\bootstrap5\Html;
use yii\bootstrap5\Widget;
use yii\helpers\ArrayHelper;

class Carousel extends \yii\bootstrap5\Carousel
{
    public $thumbnails = [];
    /*$model = Slider ::find()-> one();
		$slides = $model->slides;
		foreach($slides as $sld){
			if (($image = SliderImage::find()->where(['id' => $sld->id])->multilingual()->one()) !== null) {
			$this->items[] = [
        'content' => '<div class="home_slider_container">
		                <div class="row p-0"><div class="mx-auto">'.
		       $image->render($sld->filename,"large",["class" => "slider-img"]).	
                        '</div>',
        'caption' => '<div class="col-12">'.
		                Html::tag('h1', $image->title,['class'=>'h1 text-success']).
                       '<h3 class="h2"></h3><p>'.$image->html.'</p></div></div></div>',		
		'captionOptions' => ['class' => ['col-lg-12 mb-0 d-flex align-items-center']],
		
    ];  */

    public function init()
    {
        parent::init();
        /* Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapAsset'] = [
            'basePath'   => '@web',
           // 'sourcePath' => [],
           // 'css'        => ['css/styles.css'],
            'js'  => []
        ];*/
        Html::addCssClass($this->options, ['data-bs-ride' => 'carousel']);
        if ($this->crossfade) {
            Html::addCssClass($this->options, ['animation' => 'carousel-fade']);
        }
    }

    /**
     * Renders carousel indicators.
     * @return string the rendering result
     */
    public function renderIndicators(): string
    {
        if ($this->showIndicators === false) {
            return '';
        }
        $indicators = [];
        for ($i = 0, $count = count($this->items); $i < $count; $i++) {
            $options = [
                'data' => [
                    'bs-target' => '#' . $this->options['id'],
                    'bs-slide-to' => $i
                ],
                'type' => 'button',
                'thumb' => $this->thumbnails[$i]['thumb']
            ];
            if ($i === 0) {
                Html::addCssClass($options, ['activate' => 'active']);
                $options['aria']['current'] = 'true';
            }
            //  $indicators[] = Html::tag('button', '', $options);

            $indicators[] = Html::tag('li', Html::img($options['thumb']), $options);
        }
        return Html::tag('ol', implode("\n", $indicators), ['class' => ['carousel-indicators']]);
    }
}