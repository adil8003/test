<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subbanner".
 *
 * @property integer $id
 * @property string $subimg
 * @property string $title
 * @property string $subtitle
 * @property string $addeddate
 * @property integer $num
 */
class Subbanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subbanner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subimg', 'title', 'subtitle', 'num'], 'required'],
            [['addeddate'], 'safe'],
            [['num'], 'integer'],
            [['subimg'], 'string', 'max' => 700],
            [['title'], 'string', 'max' => 500],
            [['subtitle'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subimg' => 'Subimg',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'addeddate' => 'Addeddate',
            'num' => 'Num',
        ];
    }
}
