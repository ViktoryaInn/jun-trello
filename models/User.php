<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
//use yii\db\ActiveRecord;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'user_table';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId(){
        return $this->id;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    public function validatePassword($password)
    {
//        return Yii::$app->security->validatePassword($password, $this->password);
        return ($this->password == $password) ? true : false;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}
