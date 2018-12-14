<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dealers".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $organisation
 * @property string $address
 * @property string $addeddate
 */
class Dealers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'organisation', 'address'], 'required'],
            [['address'], 'string'],
            [['addeddate'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['email', 'phone', 'organisation'], 'string', 'max' => 700]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'organisation' => 'Organisation',
            'address' => 'Address',
            'addeddate' => 'Addeddate',
        ];
    }
}
