<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trendding".
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $addeddate
 * @property string $trendingimg
 * @property integer $statusid
 * @property integer $offer
 */
class Trendding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trendding';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subtitle', 'trendingimg', 'statusid', 'offer'], 'required'],
            [['addeddate'], 'safe'],
            [['statusid', 'offer'], 'integer'],
            [['title', 'subtitle'], 'string', 'max' => 200],
            [['trendingimg'], 'string', 'max' => 700]
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
            'addeddate' => 'Addeddate',
            'trendingimg' => 'Trendingimg',
            'statusid' => 'Statusid',
            'offer' => 'Offer',
        ];
    }
}
