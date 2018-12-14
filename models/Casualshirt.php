<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "casualshirt".
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property integer $statusid
 * @property double $price
 * @property string $addeddate
 */
class Casualshirt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casualshirt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subtitle', 'statusid', 'price'], 'required'],
            [['statusid'], 'integer'],
            [['price'], 'number'],
            [['addeddate'], 'safe'],
            [['title', 'subtitle'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'statusid' => 'Statusid',
            'price' => 'Price',
            'addeddate' => 'Addeddate',
        ];
    }
}
