<?php


namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\TaskForm;
use yii\web\Controller;


class TaskController extends Controller
{
    public function actionIndex(){
        $tasks = Task::find()->all();
        return $this->render('index', ['tasks' => $tasks]);
    }

    public function actionCreate(){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to create task');
            return $this->goHome();
        }

        $model = new TaskForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task = new Task();
            $task->title = $model->title;
            $task->description = $model->description;
            $task->status_id = 1;
            $task->author_id = Yii::$app->user->getId();
            $task->executor_id = $model->executor;
            $task->creation_date = date("Y-m-d H:i:s");
            $task->deadline_date = date_create_from_format("Y-m-d H:i:s", $model->deadline);
            if($task->save()){
                Yii::$app->session->setFlash('success', 'Задание добавлено');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Ошибка. Повторите еще раз');
        }

        return $this->render('create', compact('model'));
    }
}