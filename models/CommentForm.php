<?php


namespace app\models;
use yii\base\Model;

class CommentForm extends Model
{
    public $task;

    public function rules(){
        return [
            [['text'], 'required']
        ];
    }
}