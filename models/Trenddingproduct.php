<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trenddingproduct".
 *
 * @property integer $id
 * @property integer $trenddingid
 * @property string $title
 * @property double $offer
 * @property double $offerprice
 * @property string $addeddate
 * @property integer $productstatusid
 * @property integer $producttypeid
 * @property double $price
 * @property string $image
 * @property integer $statusid
 */
class Trenddingproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trenddingproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trenddingid', 'title', 'offer', 'offerprice', 'productstatusid', 'producttypeid', 'price', 'image', 'statusid'], 'required'],
            [['trenddingid', 'productstatusid', 'producttypeid', 'statusid'], 'integer'],
            [['offer', 'offerprice', 'price'], 'number'],
            [['addeddate'], 'safe'],
            [['title', 'image'], 'string', 'max' => 700]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trenddingid' => 'Trenddingid',
            'title' => 'Title',
            'offer' => 'Offer',
            'offerprice' => 'Offerprice',
            'addeddate' => 'Addeddate',
            'productstatusid' => 'Productstatusid',
            'producttypeid' => 'Producttypeid',
            'price' => 'Price',
            'image' => 'Image',
            'statusid' => 'Statusid',
        ];
    }
}
