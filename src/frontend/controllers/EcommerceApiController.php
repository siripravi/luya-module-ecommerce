<?php

namespace siripravi\ecommerce\frontend\controllers;

use siripravi\ecommerce\frontend\components\BaseController;
use siripravi\ecommerce\frontend\components\Category;
use siripravi\ecommerce\models\Group;
use siripravi\ecommerce\models\Feature;
use siripravi\ecommerce\models\Product;
use siripravi\ecommerce\models\ProductFilter;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;

class EcommerceApiController extends \luya\headless\cms\api\BaseController
{
    public function actionView($slug)
    {
        $page = Category::viewPage($slug, true);
        if (!empty(Yii::$app->params['templateTitleCategory_' . Yii::$app->language])) {
            $page->title = str_replace('{0}', $page->h1, Yii::$app->params['templateTitleCategory_' . Yii::$app->language]);
            if (!empty($model->text)) {
                $page->text = str_replace('{0}', $page->h1, Yii::$app->params['templateDescriptionCategory_' . Yii::$app->language]);
            }
            Yii::$app->view->title = $page->title;
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $page->description
            ], 'description');
        }
        $this->view->params['category_ids'] = [$page->id];
        //print_r($this->view->params['category_ids']);die;
        $searchModel = new ProductFilter(['category_id' => $page->id, 'enabled' => true]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $pImages = [];
        foreach ($dataProvider->getModels() as $k => $dap) {           // var_dump(get_class($dap));
          // var_dump($dap->cover_image_id);
            $pImages[] =[
                $dap->cover_image_id => Yii::$app->storage->getImage($dap->cover_image_id)
            ];
        //    $dap1[] = $dap;
           // var_dump($dap->cover_image_id);
      }
   //   $dataProvider->setModels($dap1);
       // echo "<pre>";
       // print_r($dataProvider->getModels()); die;

        $features = Feature::getFilterList(true, [$searchModel->category_id]);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return
            [
                'page' => $page,
                'categories' => $page->categories,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'features' => $features,
                'images' => $pImages
            ];
    }
}
