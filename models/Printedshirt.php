<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printedshirt".
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property integer $statusid
 * @property double $price
 * @property string $addeddate
 */
class Printedshirt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'printedshirt';
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
