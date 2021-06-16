<?php


namespace app\models;
use yii\base\Model;

class CommentForm extends Model
{
    public $text;

    public function rules(){
        return [
            [['text'], 'required', 'message' => 'Fill in the field']
        ];
    }

    public function attributeLabels() {
        return [
            'text' => 'Text of comment',
        ];
    }
}