<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shirtimages".
 *
 * @property integer $id
 * @property integer $newarrivalproductid
 * @property integer $trenddingproductid
 * @property integer $shirtcategoriesid
 * @property integer $type
 * @property string $images
 * @property string $imgtype
 * @property string $addeddate
 */
class Shirtimages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shirtimages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newarrivalproductid', 'trenddingproductid', 'shirtcategoriesid', 'type'], 'integer'],
            [['images'], 'string'],
            [['addeddate'], 'safe'],
            [['imgtype'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newarrivalproductid' => 'Newarrivalproductid',
            'trenddingproductid' => 'Trenddingproductid',
            'shirtcategoriesid' => 'Shirtcategoriesid',
            'type' => 'Type',
            'images' => 'Images',
            'imgtype' => 'Imgtype',
            'addeddate' => 'Addeddate',
        ];
    }
}
