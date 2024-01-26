<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 24.12.17
 * Time: 15:46
 */

namespace siripravi\ecommerce\models;

//use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\base\Model;

class ReviewForm extends Model
{
    public $name;
    public $email;
    public $text;
    public $rating;
    public $reCaptcha;
    public $product_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text', 'email', 'rating'], 'required'],
            [['name', 'text', 'email'], 'string'],
            [['rating', 'product_id'], 'integer'],
            [['email'], 'email'],
            /*['reCaptcha', ReCaptchaValidator2::class, 'uncheckedMessage' => Yii::t('app', 'Please confirm that you are not a bot.')],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Your name'),
            'email' => Yii::t('app', 'Your E-mail'),
            'text' => Yii::t('app', 'Review text'),
            'rating' => Yii::t('app', 'Stars'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'email' => Yii::t('app', 'This E-mail address will not be published'),
        ];
    }

    public function send()
    {
        $model = new Review([
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
            'rating' => $this->rating,
            'product_id' => $this->product_id,
        ]);

        if ($model->save()) {
            return true;
        }

        return false;
    }
}