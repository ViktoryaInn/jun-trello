<?php

use app\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\Task;
use yii\data\Pagination;

/* @var $this yii\web\View */

$this->title = 'Tasks';

//$dataProvider = new ActiveDataProvider([
//    'query' => Task::find(),
//    'pagination' => [
//        'pageSize' => 5,
//    ],
//]);
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


<!--<script>-->
<!--    function search_by_title() {-->
<!--        var title = document.getElementById("search").value;-->
<!--        window.location.replace("/site/task-search?title=" + title);-->
<!--    }-->
<!---->
<!--    function filterBy(filter) {-->
<!--        var name = document.getElementById(filter).value;-->
<!--        window.location.replace("/task/task-filter?filter=" + filter + "&name=" + name);-->
<!--    }-->
<!--</script>-->
<!--<div class="task-index">-->
<!--    <div class="body-content">-->
<!---->
<!--        <div class="jumbotron">-->
<!--            <h1>List of tasks</h1>-->
<!---->
<!--            <p><a class="btn btn-lg btn-success" href="/task/create">Create task</a></p>-->
<!--        </div>-->
<!---->
<!--        <select id="status" onchange="filterBy('status')">-->
<!--            <option>Status</option>-->
<!--            --><?php //foreach ($statuses as $status) { ?>
<!--                <option>--><?//=$status->name?><!--</option>-->
<!--            --><?php //} ?>
<!--        </select>-->
<!---->
<!--        <select id="author" onchange="filterBy('author')">-->
<!--            <option>Author</option>-->
<!--            --><?php //foreach ($users as $user) { ?>
<!--                <option>--><?//=$user->login?><!--</option>-->
<!--            --><?php //} ?>
<!--        </select>-->
<!---->
<!--        <select id="executor" onchange="filterBy('executor')">-->
<!--            <option>Executor</option>-->
<!--            --><?php //foreach ($users as $user) { ?>
<!--                <option>--><?//=$user->login?><!--</option>-->
<!--            --><?php //} ?>
<!--        </select>-->
<!---->
<!--        <div class="card-list">-->
<!--            <div class="list-wrap">-->
<!--                --><?php //foreach ($tasks as $task): ?>
<!--                <div class="card">-->
<!--                    <div class="card-header">-->
<!--                        <h3 class="card-title">-->
<!--                            <a href="--><?//= \yii\helpers\Url::toRoute(['task/view', 'id' => $task->id]) ?><!--">-->
<!--                                --><?//= $task->title ?>
<!--                            </a>-->
<!--                        </h3>-->
<!--                    </div>-->
<!---->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text">--><?//= $task->description ?><!--</p>-->
<!--                        <p class="card-text"><b>Status: </b>--><?//= Status::findStatus($task->status_id)->name ?><!--</p>-->
<!--                        <p class="card-text"><b>Author: </b>--><?//= User::findIdentity($task->author_id)->login ?><!--</p>-->
<!--                        <p class="card-text"><b>Author: </b>--><?//= User::findIdentity($task->executor_id)->login ?><!--</p>-->
<!--                        <p class="card-text"><b>Deadline: </b>--><?//= $task->deadline_date ?><!--</p>-->
<!--                        <p><a class="btn btn-primary" href="--><?//= \yii\helpers\Url::toRoute(['task/update', 'id' => $task->id]) ?><!--">Update task</a></p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="card-footer">-->
<!--                        <small class="text-muted">--><?//= $task->creation_date ?><!--</small>-->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php //endforeach; ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--<style>-->
<!--    .card-list{-->
<!--        display: flex;-->
<!--        flex-direction: row;-->
<!--        justify-content: center;-->
<!--        flex-wrap: wrap;-->
<!--    }-->
<!---->
<!--    .list-wrap{-->
<!--        display: flex;-->
<!--        flex-wrap: wrap;-->
<!--        flex-direction: row;-->
<!--        justify-content: center;-->
<!--    }-->
<!---->
<!--    .card{-->
<!--        margin: 15px;-->
<!--        width: 350px;-->
<!--        max-height: 350px;-->
<!--        padding: 10px 30px;-->
<!--        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.35);-->
<!--        border-radius: 5px;-->
<!--    }-->
<!---->
<!--    .card-body{-->
<!--        margin: 30px 0px;-->
<!--    }-->
<!--</style>-->


