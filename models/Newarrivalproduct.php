<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newarrivalproduct".
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property double $price
 * @property double $offerprice
 * @property integer $offer
 * @property string $addeddate
 * @property integer $statusid
 * @property integer $productstatusid
 */
class Newarrivalproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newarrivalproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subtitle', 'price', 'offerprice', 'offer', 'statusid', 'productstatusid'], 'required'],
            [['price', 'offerprice'], 'number'],
            [['offer', 'statusid', 'productstatusid'], 'integer'],
            [['addeddate'], 'safe'],
            [['title', 'subtitle'], 'string', 'max' => 500]
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
            'price' => 'Price',
            'offerprice' => 'Offerprice',
            'offer' => 'Offer',
            'addeddate' => 'Addeddate',
            'statusid' => 'Statusid',
            'productstatusid' => 'Productstatusid',
        ];
    }
}
