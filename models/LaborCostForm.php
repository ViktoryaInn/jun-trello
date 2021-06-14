<?php


namespace app\models;

use yii\base\Model;

class LaborCostForm extends Model
{
    public $time;
    public $comment;

    public function rules() {
        return [
            [['time','comment'], 'required', 'message' => 'Fill in the field'],
        ];
    }

    public function attributeLabels() {
        return [
            'time' => 'Time',
            'comment' => 'Comment',
        ];
    }
}