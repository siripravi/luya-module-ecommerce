<?php

namespace siripravi\ecommerce\frontend\components;

use siripravi\ecommerce\models\Group;
use Yii;
use yii\web\NotFoundHttpException;

class Category extends Group
{
    public static function viewPage($id)
    {
        if (is_numeric($id)) {
            $page = self::findOne($id);
        } else {
            $page = self::findOne(['slug' => $id]);
        }

        if ($page === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        Yii::$app->view->params['page'] = $page;

        Yii::$app->view->title = $page->name;

        if ($page->text) {
            Yii::$app->view->registerMetaTag([
                'name' => 'text',
                'content' => $page->text
            ], 'description');
        }

        /* if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->keywords
            ], 'keywords');
        }*/

        if (Yii::$app->request->get('page')) {
            $page->name .= ' - ' . Yii::t('app', 'page {0}', Yii::$app->request->get('page'));
            $page->text .= ' - ' . Yii::t('app', 'page {0}', Yii::$app->request->get('page'));
            Yii::$app->view->title = $page->name;
            Yii::$app->view->registerMetaTag([
                'name' => 'text',
                'content' => $page->text,
            ], 'text');
        }

        return $page;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Group::class, ['id' => 'parent_id']);
    }
}
