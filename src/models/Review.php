<?php

namespace siripravi\ecommerce\models;

use app\models\Product;
//use common\modules\sortable\behaviors\SortableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $answer
 * @property string $email
 * @property integer $rating
 * @property integer $created_at
 * @property integer $position
 * @property integer $status
 * @property integer|null $product_id
 *
 * @property Product $product
 */
class Review extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_NEW = 1;
    const STATUS_UNPUBLISHED = 2;
    const STATUS_PUBLISHED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_review';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
          //  SortableBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'rating'], 'required'],
            [['text', 'answer'], 'string'],
            [['rating', 'created_at', 'position', 'status', 'product_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_NEW, self::STATUS_UNPUBLISHED, self::STATUS_PUBLISHED]],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Теxt',
            'answer' => 'Answer',
            'email' => 'E-mail',
            'rating' => 'Rating',
            'created_at' => 'Created On',
            'position' => 'Position',
            'status' => 'Status',
            'product_id' => 'Product',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function unread()
    {
        return self::find()->where(['status' => self::STATUS_NEW])->count();
    }

    public static function read($id = null)
    {
        /** @var $temp Review[] */
        $temp = self::find()->where(['status' => self::STATUS_NEW])->andFilterWhere(['id' => $id])->all();

        foreach ($temp as $t) {
            $t->status = self::STATUS_UNPUBLISHED;
            $t->save();
        }
    }

    public static function statusList()
    {
        return [
            self::STATUS_DELETED => 'Deleted',
            self::STATUS_NEW => 'New',
            self::STATUS_UNPUBLISHED => 'Waiting Approval',
            self::STATUS_PUBLISHED => 'Approved',
        ];
    }
}
