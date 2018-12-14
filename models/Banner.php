<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $bannerimg
 * @property string $addeddate
 * @property string $title
 * @property string $subtitle
 * @property integer $statusid
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bannerimg', 'title', 'subtitle', 'statusid'], 'required'],
            [['addeddate'], 'safe'],
            [['statusid'], 'integer'],
            [['bannerimg'], 'string', 'max' => 700],
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
            'bannerimg' => 'Bannerimg',
            'addeddate' => 'Addeddate',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'statusid' => 'Statusid',
        ];
    }
}
