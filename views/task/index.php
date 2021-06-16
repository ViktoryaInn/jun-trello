<?php

use app\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */

$this->title = 'Tasks';
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
            'attribute' => 'status',
            'label' => 'Status',
            'value' => 'status.name',
            'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'name'),
            'filterInputOptions' => ['class' => 'form-control form-control-sm']
        ],
        [
            'attribute' => 'author',
            'label' => 'Author',
            'value'=>'author.login',
            'filter' => ArrayHelper::map(User::find()->all(), 'id', 'login'),
            'filterInputOptions' => ['class' => 'form-control form-control-sm']
        ],
        [
            'attribute' => 'executor',
            'label' => 'Executor',
            'value'=>'executor.login',
            'filter' => ArrayHelper::map(User::find()->all(), 'id', 'login'),
            'filterInputOptions' => ['class' => 'form-control form-control-sm']
        ],
        'creation_date',
        'deadline_date',
        [ 'class' => 'yii\grid\ActionColumn']
    ],
]) ?>

<a href="/task/create" class="btn btn-success">Create task</a>



