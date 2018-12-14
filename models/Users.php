<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property string $address
 * @property string $image
 * @property integer $statusid
 * @property string $addeddate
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mobile', 'email', 'password', 'address', 'image', 'statusid'], 'required'],
            [['mobile', 'statusid'], 'integer'],
            [['addeddate'], 'safe'],
            [['name', 'email', 'address', 'image'], 'string', 'max' => 500],
            [['password'], 'string', 'max' => 700]
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
            'mobile' => 'Mobile',
            'email' => 'Email',
            'password' => 'Password',
            'address' => 'Address',
            'image' => 'Image',
            'statusid' => 'Statusid',
            'addeddate' => 'Addeddate',
        ];
    }
}
