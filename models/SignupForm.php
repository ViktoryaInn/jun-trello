<?php


namespace app\models;

use  yii\base\Model;

class SignupForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required', 'message' => 'Fill in the field'],
            ['login', 'unique', 'targetClass' => User::className(), 'message' => 'This login already exists']
        ];
    }

    public function fieldLabels(){
        return[
            'login' => 'Login',
            'password' => 'Password'
        ];
    }
}