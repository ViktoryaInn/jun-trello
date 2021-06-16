<?php

/* @var $this yii\web\View */

use app\models\Status;
use app\models\User;
use yii\helpers\Html;

$this->title = 'View task';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <?= $task->title ?>
                </h3>
            </div>

            <div class="card-body">
                <p class="card-text"><?= $task->description ?></p>
                <p class="card-text"><b>Status: </b><?= Status::findStatus($task->status_id)->name ?></p>
                <p class="card-text"><b>Author: </b><?= User::findIdentity($task->author_id)->login ?></p>
                <p class="card-text"><b>Executor: </b><?= User::findIdentity($task->executor_id)->login ?></p>
                <p class="card-text"><b>Deadline: </b><?= $task->deadline_date ?></p>
                <div>
                    <span><a class="btn btn-primary" href="<?= \yii\helpers\Url::toRoute(['task/update', 'id' => $task->id]) ?>">Update task</a></span>
                    <span><a class="btn btn-danger" href="<?= \yii\helpers\Url::toRoute(['task/delete', 'id' => $task->id]) ?>">Delete task</a></span>
                </div>

            </div>

            <div class="card-footer">
                <small class="text-muted"><?= $task->creation_date ?></small>
            </div>
        </div>

        <div class="comments">
            <a href="/comment/create" class="btn btn-success">Create task</a>
        </div>
    </div>
</div>
<style>
    .card-list{
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
    }

    .list-wrap{
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
    }

    .card{
        margin: 15px;
        width: 100%;
        max-height: 350px;
        padding: 10px 30px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.35);
        border-radius: 5px;
    }

    .card-body{
        margin: 30px 0px;
    }
</style>
