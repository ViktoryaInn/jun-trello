<?php


namespace app\models;

use yii\db\ActiveRecord;

class LaborCost extends ActiveRecord
{
    public static function tableName()
    {
        return 'labor_cost_table';
    }
}