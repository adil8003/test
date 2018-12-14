<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shirts".
 *
 * @property integer $id
 * @property integer $shirttypeid
 * @property integer $qty
 * @property integer $offer
 * @property string $addeddate
 */
class Shirts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shirts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shirttypeid', 'qty'], 'required'],
            [['shirttypeid', 'qty', 'offer'], 'integer'],
            [['addeddate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shirttypeid' => 'Shirttypeid',
            'qty' => 'Qty',
            'offer' => 'Offer',
            'addeddate' => 'Addeddate',
        ];
    }
}
