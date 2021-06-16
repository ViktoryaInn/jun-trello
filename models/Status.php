<?php


namespace app\models;

use yii\db\ActiveRecord;

class Status extends ActiveRecord
{
    public static function tableName()
    {
        return 'status_table';
    }

    public static function findStatus($id){
        return static::findOne($id);
    }
}