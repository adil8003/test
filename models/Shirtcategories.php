<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shirtcategories".
 *
 * @property integer $id
 * @property integer $shirtsid
 * @property string $title
 * @property integer $statusid
 * @property integer $offer
 * @property double $price
 * @property double $offerprice
 * @property string $addeddate
 * @property integer $producttypeid
 * @property integer $productstatusid
 * @property string $images
 */
class Shirtcategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shirtcategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shirtsid', 'title', 'statusid', 'offer', 'price', 'offerprice', 'producttypeid', 'productstatusid', 'images'], 'required'],
            [['shirtsid', 'statusid', 'offer', 'producttypeid', 'productstatusid'], 'integer'],
            [['price', 'offerprice'], 'number'],
            [['addeddate'], 'safe'],
            [['images'], 'string'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shirtsid' => 'Shirtsid',
            'title' => 'Title',
            'statusid' => 'Statusid',
            'offer' => 'Offer',
            'price' => 'Price',
            'offerprice' => 'Offerprice',
            'addeddate' => 'Addeddate',
            'producttypeid' => 'Producttypeid',
            'productstatusid' => 'Productstatusid',
            'images' => 'Images',
        ];
    }
}
