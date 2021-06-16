<?php


namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class Task extends ActiveRecord
{
    public static function tableName()
    {
        return 'task_table';
    }

    public static function findOne($id)
    {
        return parent::findOne($id);
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getStatus(){
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getAuthor(){
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getExecutor(){
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }
}