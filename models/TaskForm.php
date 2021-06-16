<?php


namespace app\models;

use yii\base\Model;

class TaskForm extends Model
{
    public $title;
    public $description;
    public $author;
    public $executor;
    public $deadline;

    public function rules(){
        return [
            [['title', 'description', 'executor', 'deadline'], 'required', 'message' => 'Fill in the field']
        ];
    }

    public function attributeLabels(){
        return[
            'title' => 'Name',
            'description' => 'Description',
            'executor' => 'Executor',
            'deadline' => 'Deadline',
        ];
    }
}