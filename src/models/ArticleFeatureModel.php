<?php

namespace siripravi\ecommerce\models;

use luya\base\DynamicModel;
use app\modules\shopcart\models\Cart;
use yii\helpers\ArrayHelper;
use luya\helpers\StringHelper;

use yz\shoppingcart\CartPositionInterface;
use hscstudio\cart\ItemTrait;
use Yii;

/**
 * Form Submission Model
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ArticleFeatureModel extends \luya\forms\Model implements CartPositionInterface 
{
    use ItemTrait;
    /**
     * @var string The uniue form id
     */
    public $formId;
    public $Pid;
    public $Name;
    public $Features = [];

    public $Quantity = 1;
    public $Price;
    public $Delivery;
    public $Message;
    public $FeatureText;
    public $forNew = true;
    public $isPjax = false;
    public $pjaxOptions = ['id' => 'feat-pjax'];
    public $redirectUrl = "/shopcart";

    public $activeFormClassOptions = ['id' => 'cart-form'];
    /**
     * @var array An array where the key is the attribute and value the formatter option, like
     * ```php
     * 'firstname' => 'ntext',
     * ```
     */
    public $formatters = [];
    const EVENT_AFTER_SAVE = 'afterSave';

    public function init()
    {
        parent::init();

        //bind after confirmation event
        $this->on(
            self::EVENT_AFTER_SAVE,
            [
                new \siripravi\ecommerce\AfterSaveFeaturesHandler(),
                'handleAfterSave',
            ]
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['Pid', 'Features', 'FeatureText', 'Price', 'Delivery', 'Message'], 'safe']
            ]
        );
    }
    /**
     * Format a given attribute
     *
     * @param string $attribute
     * @param string $value
     * @return string
     */
    public function formatAttributeValue($attribute, $value)
    {
        $value = is_array($value) ? implode(", ", $value) : $value;

        if (isset($this->formatters[$attribute]) && !empty($this->formatters[$attribute])) {
            return Yii::$app->formatter->format($value, $this->formatters[$attribute]);
        }
        return Yii::$app->formatter->autoFormat($value);
    }

    private $_invisibleAttributes = [];

    /**
     * An invisible attribute will not be shown in the confirm page
     * nor the value will be stored when saving the form data.
     *
     * The invisible attributes won't be validated when switching from "confirm"
     * step to "save" step, the invisble attributes will only validate from "form input"
     * to "confirm" step. The main reason for this and also for introduction of invisible
     * attributes are captcha codes. They need to be validated once, afterwards they are
     * not valid anymore and should therfore not be validated in a second process.
     *
     * @param string $attributeName
     */
    public function invisibleAttribute($attributeName)
    {
        $this->_invisibleAttributes[] = $attributeName;
    }

    /**
     * Whether the given attribute is in the list of invisible attributes.
     *
     * @param string $attributeName
     * @return boolean
     */
    public function isAttributeInvisible($attributeName)
    {
        return in_array($attributeName, $this->_invisibleAttributes);
    }

    /**
     * Returns all attribute names without the attributes tagged as invisible
     *
     * @return array
     */
    public function getAttributesWithoutInvisible()
    {
        $result = [];
        foreach ($this->attributes() as $attributeName) {
            if (!$this->isAttributeInvisible($attributeName)) {
                $result[] = $attributeName;
            }
        }
        return $result;
    }

    public static function saveCartCookie($model)
    {
        $id = implode("+", $model->Features);
        $ftext = $model->FeatureText;
        $pid = $model->Pid;
        $price = $model->Price;
        $cart = Cart::getCart();
        if (isset($cart[$id])) {
            return false;
        }
        $qty = isset($cart[$id]) ? $cart[$id]["qty"] + 1 : 1;
        ArrayHelper::setValue($cart, $id, ["qty" =>  $qty, "pid" => $pid, "ftext" => $ftext, "price" => $price]);
        Cart::setCart($cart);
    }

    public static function getAfterSaveEvent(self $model)
    {
        return \Yii::createObject(['class' => \siripravi\ecommerce\AfterSaveFeaturesEvent::class, 'model' => $model]);
    }

    /* 6-inch-5-layer_36_2354+Eggless_31_251  */
    public function formatFText($ftext)
    {
        $words = [];
        $price = 0;
        $wor = StringHelper::explode($ftext, "+");
        if (count($wor) > 0) {
            foreach ($wor as $i => $word) {
                $words[$i] = StringHelper::explode($word, "_");
                if (count($words[$i]) == 3)
                    $price += ($words[$i][2]) ?: 0;
                $words[$i]['price'] = $price;
            }
        }
        return $words;
        // ArrayHelpers::map($words,)
    }
    public function getName()
    {
       // return "Product Name";
        $model = Article::findOne(['id' => $this->Pid, 'enabled' => 1]);
        return $model->name;
    }
    public function getPrice()
    {
        return $this->Price;
    }

    public function getId()
    {
        //return $this->id;
        return implode("+", $this->Features);
    }
 /*   public function getCartPosition()
    {
        return \Yii::createObject([
            'class' => 'app\models\ProductCartPosition',
            'id' => $this->id,
        ]);
    }*/
}
