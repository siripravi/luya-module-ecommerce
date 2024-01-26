<?php

namespace siripravi\ecommerce\frontend\controllers;

use siripravi\ecommerce\models\Product;
use siripravi\ecommerce\models\Group;
use siripravi\ecommerce\models\Article;
use siripravi\ecommerce\models\Feature;
use siripravi\ecommerce\models\Review;
use siripravi\ecommerce\models\ReviewForm;
use Yii;
use yii\web\View;
use yii\web\NotFoundHttpException;
use Exception;
use siripravi\ecommerce\frontend\components\BaseController;
use luya\helpers\ArrayHelper;
use luya\helpers\Html;
use luya\helpers\Json;
use luya\helpers\Url;
use luya\helpers\StringHelper;
use luya\cms\models\Redirect;
use siripravi\shopcart\models\Cart;
use siripravi\shopcart\models\Order;
use siripravi\shopcart\models\OrderForm;
use app\modules\cart\widgets\CartWidget;

use yii\data\ActiveDataProvider;
use CacheableTrait;
class DefaultController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['modal', 'add', 'del'],
            ],
        ];
    }

    public function actions()
    {
        return [
            'delivery' => DeliveryAction::class,
            'payment' => PaymentAction::class,
        ];
    }
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Article::find()
                ->andWhere(['enabled' => 1]),
            //  ->with(['createUser']),
            'sort' => [
                'defaultOrder' => $this->module->articleDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => ['page' => Yii::$app->request->get('page')],
                'defaultPageSize' => $this->module->articleDefaultPageSize,
            ],
        ]);

        return $this->render('index', [
            'model' => Article::class,
            'provider' => $provider,
        ]);
    }

    /**
     * Detail Action of an article by Id.
     *
     * @param integer $id
     * @param string $title
     * @return \yii\web\Response|string
     */
    public function actionDetail($id, $title = "")
    {
        $model = Article::findOne(['id' => $id, 'enabled' => 1]);
       
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $product = Product::viewPage($model->product_id);

        if (!$product->enabled) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $this->view->params['category_ids'] = $product->group_ids;

        /**
         * Save viewed products
         */
        $viewed_ids = Yii::$app->request->cookies->getValue('viewed_ids', 'a:0:{}');
        $viewed_ids = unserialize($viewed_ids);
        array_unshift($viewed_ids, $product->id);
        $viewed_ids = array_unique($viewed_ids);
        $viewed_ids = array_slice($viewed_ids,  0, 7);
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'viewed_ids',
            'value' => serialize($viewed_ids),
            'expire' => time() + 3600 * 24 * 30
        ]));
        $viewed_ids = array_diff($viewed_ids, [$product->id]);
        $similar = []; //Product::find()->where(['id' => $viewed_ids])->all();
       
        if (count($similar) < 1) {
        $viewed = 0;
        $similar = Product::find()->joinWith(['groups','articles'])->where(['catalog_product.enabled' => 1, 'group_id' => $product->group_ids])->andWhere(['!=', 'catalog_product.id', $product->id])->limit(6)->all();
   
        } else {
            $viewed = 1;
        }

        /* Similar products */

        $view = 'index';

        /* if ($model->view) {
            $view = $model->view;  //ie., 'accessory' || 'container'
        }*/

        if (!empty(Yii::$app->params['templateTitle_' . Yii::$app->language])) {
            $product->title = str_replace('{0}', $model->h1, Yii::$app->params['templateTitle_' . Yii::$app->language]);

            if (empty($product->text)) {
                $product->text = str_replace('{0}', $model->h1, Yii::$app->params['templateDescription_' . Yii::$app->language]);
            }

            Yii::$app->view->title = $product->name;
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $product->text
            ], 'text');
        }

        $reviewForm = new ReviewForm();
        $reviewForm->product_id = $product->id;

        if ($reviewForm->load(Yii::$app->request->post()) && $reviewForm->send()) {
            Yii::$app->session->setFlash('reviewSubmitted');
            return $this->refresh('#card-form');
        }

        $reviewProvider = new ActiveDataProvider([
            'query' => Review::find()->where(['status' => Review::STATUS_PUBLISHED, 'product_id' => $product->id]),
            'sort' => [
                'defaultOrder' => [
                    'position' => SORT_DESC
                ],
            ],
        ]);

         $rating = Review::find()
            ->select(['SUM(rating) sum', 'COUNT(*) count'])
            ->where(['status' => Review::STATUS_PUBLISHED, 'product_id' => $model->id])
            ->asArray()
            ->one();

        if (!empty($rating['count'])) {
            $rating['value'] = round($rating['sum'] / $rating['count'], 1);
        } else {
            $rating = [
                'count' => 0,
                'value' => 0,
            ];
        }
        $features = Feature::getObjectList(true, $product->group_ids);
        // $features = Feature::getFilterList(true, [$searchModel->category_id]);
      
        return $this->render('detail', [
            'model' => $model,
            'product' => $product,
            'viewed' => $viewed,
            'similar' => $similar,
            'features' => $features,
             'reviewForm' => $reviewForm,
             'reviewProvider' => $reviewProvider,
             'rating' => $rating,
            
        ]);
    }

    /**
     * Get all articles for a given categorie ids string seperated by command.
     *
     * @param string $ids The categorie ids: `1,2,3`
     * @return \yii\web\Response|string
     */
    public function actionCategories($ids)
    {
        $ids = explode(",", Html::encode($ids));
        
        if (!is_array($ids)) {
            throw new NotFoundHttpException();
        }
        
        $provider = new ActiveDataProvider([
            'query' => Article::find()->where(['in', 'group_id', $ids])->andWhere(['enabled' => 1]),
            'sort' => [
                'defaultOrder' => $this->module->articleDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => ['page' => Yii::$app->request->get('page')],
                'defaultPageSize' => $this->module->articleDefaultPageSize,
            ],
        ]);
        
        return $this->render('categories', [
            'provider' => $provider,
        ]);
    }

     /**
     * Get the category Model for a specific ID.
     *
     * The most common way is to use the active data provider object inside the $provider variable:
     *
     * ```php
     * foreach ($provider->getModels() as $cat) {
     *     var_dump($cat);
     * }
     * ```
     *
     * Inside the Cat Object you can then retrieve its articles:
     *
     * ```php
     * foreach ($model->articles as $item) {
     *
     * }
     * ```
     *
     * or customize the where query:
     *
     * ```php
     * foreach ($model->getArticles()->where(['timestamp', time())->all() as $item) {
     *
     * }
     * ```
     *
     * @param integer $categoryId
     * @return \yii\web\Response|string
     */
    public function actionCategory($categoryId)
    {
        $model = Group::findOne($categoryId);
        
        if (!$model) {
            throw new NotFoundHttpException();
        }
        
        $provider = new ActiveDataProvider([
            'query' => $model->getArticles()->andWhere(['enabled' => 1]),
            'sort' => [
                'defaultOrder' => $this->module->categoryArticleDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => ['page' => Yii::$app->request->get('page')],
                'defaultPageSize' => $this->module->categoryArticleDefaultPageSize,
            ],
        ]);
        
        return $this->render('category', [
            'model' => $model,
            'provider' => $provider,
        ]);
    }

    public function actionIndex1()
    {
        $groups = Group::getMenu();
        $items = Article::getElements();

        return $this->render('index', [
            'groups' => $groups,
            'items' => $items
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCart()
    {

        $cart = Cart::getCart();
        $article_ids = array_keys($cart);

        /** @var Variant[] $items */
        $items = Article::find()->where(['id' => $article_ids])->andWhere(['enabled' => true])->all();

        $notAvailable = false;

        foreach ($items as $item) {
            if ($item->available <= 0) {
                $notAvailable = true;
            }
        }

        $model = new OrderForm();

        $model->scenario = 'user';

        if ($model->load(Yii::$app->request->post()) && $order_id = $model->send()) {
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'order',
                'value' => $order_id,
                'expire' => time() + 3600 * 24 * 7,
            ]));
            Yii::$app->session->setFlash('orderSubmitted');
            //if Yii::$app->params['sendSputnikOrder'] &&
            if ($model->email && $order = Order::findOne($order_id)) {
                $products = [];
                foreach ($order->products as $product) {
                    $image = null;
                    if ($product->image) {
                        $image = ""; //Url::to(ImageHelper::thumb($product->image->id, 'micro'), 'https');
                    } elseif ($product->product->image) {
                        $image = ""; //Url::to(ImageHelper::thumb($product->product->image->id, 'micro'), 'https');
                    }
                    $products[] = [
                        'imageUrl' => $image,
                        'url' => Url::to(['/catalog/product/index', 'slug' => $product->product->slug], 'https'),
                        'name' => (string)$order->cartItemName[$product->id],
                        'cost' => (string)$order->cartItemPrice[$product->id],
                        'quantity' => (string)$order->cartItemCount[$product->id],
                    ];
                }
                /*Yii::$app->esputnik->event('zakaz', $order->email, [
                    'externalOrderId' => (string)$order->id,
                    'firstName' => (string)$order->buyer->name,
                    'email' => (string)$order->email,
                    'phone' => (string)$order->phone,
                    'totalCost' => (string)$order->amount,
                    'paymentMethod' => $order->payment_id ? (string)$order->paymentMethod->name : null,
                    'deliveryMethod' => $order->delivery_id ? $order->deliveryMethod->name . ($order->delivery ? ', ' . Html::encode($order->delivery) : null) : null,
                    'products' => $products,
                ]);*/
            }

            return $this->redirect(['/order', 'id' => $order_id, 'hash' => md5($order_id . Yii::$app->params['order_secret'])]);
        }

        return $this->render('cart', [
            //  'page' => $page,
            'items' => $items,
            'cart' => $cart,
            'model' => $model,
            'notAvailable' => $notAvailable,
        ]);
    }

    /**
     * @return int Calculate the number of basket items
     */
    public function getBasketCount()
    {
        return 10;
    }

    /**
     * @return string
     */
    public function actionOffcanvas()
    {
        $footer = Html::button(Yii::t('app', 'Continue shopping'), ['class' => 'btn btn-primary mr-auto', 'data-dismiss' => 'modal']);
        $footer .= Html::a(Yii::t('app', 'Place an order'), ['cart'], ['class' => 'btn btn-warning']);
        $cart = Cart::getCart();
        $article_ids = array_keys($cart);

        $items = Article::find()->where(['id' => $article_ids])->andWhere(['enabled' => true])->all();

        $data = [
            'title' => Yii::t('app', 'Your Cart Items'),
            'body' => $this->renderAjax('offcanvas', [
                'items' => $items,
                'cart' => $cart,
            ]),
            'footer' => $footer,
            'dialog' => 'modal-lg',
        ];

        return Json::encode($data);
    }


    /**
     * Returns all basket items for this user.
     */
    public function actionBasket()
    {
        // add your basket action logic
        return $this->renderLayout('basket', ['morning' => 'MORNING']);
    }

    /**
     * Display confirmation page.
     */
    public function actionConfirm()
    {
        // add your confirmation action logic
        return $this->renderLayout('confirm');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function actionBlock()
    {
        return CartWidget::widget();
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionDel($id)
    {
        $cart = Cart::getCart();

        ArrayHelper::remove($cart, $id);

        return Cart::setCart($cart);
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionAdd($id)
    {
        $cart = Cart::getCart();

        ArrayHelper::setValue($cart, $id, ArrayHelper::getValue($cart, $id) + 1);

        return Cart::setCart($cart);
    }

    /**
     * @param $id
     * @param $count
     * @return bool
     */
    public function actionSet($id, $count)
    {
        $cart = Cart::getCart();

        $cart[$id] = $count;

        return Cart::setCart($cart);
    }

    public function getTopProducts($count = 10)
{
    return $this->getOrSetHasCache(['top-n-products', 'n' => $count], function ($cache) use ($count) {
        return Product::find()->mostPopular()->limit(10)->all();
    }, 1000);
}
}
