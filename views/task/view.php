<?php

/* @var $this yii\web\View */

use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'View task';
?>
<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content">

        <div class="primary-content">
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
                        <span><a class="btn btn-primary" href="<?= Url::toRoute(['task/update', 'id' => $task->id]) ?>">Update task</a></span>
                        <span><a class="btn btn-danger" href="<?= Url::toRoute(['task/delete', 'id' => $task->id]) ?>">Delete task</a></span>
                    </div>
                </div>

                <div class="card-footer">
                    <small class="text-muted"><?= $task->creation_date ?></small>
                </div>
            </div>
        </div>



        <div class="secondary-content">
            <div class="comments">
                <h2>Comments</h2>
                <a href="<?= Url::toRoute(['/comment/create', 'taskId' => $task->id] )?>" class="btn btn-lg btn-success">Add comment</a>
                <div>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-card">
                            <div class="comment-card-body">
                                <p class="card-text"><?= $comment->text ?></p>
                            </div>

                            <div class="card-footer">
                                <small class="text-muted"><b>Created by: </b><?= User::findIdentity($comment->user_id)->login ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="comments">
                <h2>Labor costs</h2>
                <a href="<?= Url::toRoute(['/labor-cost/create', 'taskId' => $task->id] )?>" class="btn btn-lg btn-success">Add labor cost</a>
                <div>
                    <?php foreach ($laborCosts as $laborCost): ?>
                        <div class="comment-card">
                            <div class="comment-card-body">
                                <p class="card-text"><b>Time: </b><?= $laborCost->time ?></p>
                                <p class="card-text"><b>Comment: </b><?= $laborCost->comment ?></p>
                            </div>

                            <div class="card-footer">
                                <small class="text-muted"><b>Created by: </b><?= User::findIdentity($laborCost->user_id)->login ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<style>
    .comment-card{
        margin: 15px;
        width: 100%;
        max-height: 350px;
        padding: 10px 30px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
        border-radius: 5px;
    }

    .comment-card-body{
        margin: 15px 0;
    }

    .card{
        margin: 15px;
        width: 100%;
        max-height: 350px;
        padding: 10px 30px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.35);
        border-radius: 5px;
    }

    .card-body{
        margin: 30px 0;
    }

    .comments{
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .secondary-content{
        display: flex;
    }
</style>
