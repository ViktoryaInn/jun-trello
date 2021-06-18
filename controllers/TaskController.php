<?php


namespace app\controllers;

use app\models\Comment;
use app\models\LaborCost;
use app\models\Status;
use app\models\TaskSearchModel;
use app\models\User;
use Yii;
use app\models\Task;
use app\models\TaskForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;


class TaskController extends Controller
{
    public function actionIndex(){
        $searchModel = new TaskSearchModel();
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false
            ]
        ]);
        $searchModel->load(Yii::$app->request->getQueryParams());

        $query->joinWith(['status']);
        $dataProvider->sort->attributes['status'] = [
            'asc' => [Status::tableName().'.name' => SORT_ASC],
            'desc' => [Status::tableName().'.name' => SORT_DESC],
        ];

        $query->joinWith(['author']);
        $dataProvider->sort->attributes['author'] = [
            'asc' => [User::tableName().'.login' => SORT_ASC],
            'desc' => [User::tableName().'.login' => SORT_DESC],
        ];

        $query->joinWith(['executor']);
        $dataProvider->sort->attributes['executor'] = [
            'asc' => [User::tableName().'.login' => SORT_ASC],
            'desc' => [User::tableName().'.login' => SORT_DESC],
        ];

        $query->andWhere('title like "%' . $searchModel->title . '%" ');
        $query->andWhere('status_id like "%' . $searchModel->status . '%" ');
        $query->andWhere('author_id like "%'.$searchModel->author.'%" ');
        $query->andWhere('executor_id like "%'.$searchModel->executor.'%" ');

        return $this->render('index', ['dataProvider'=>$dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreate(){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to create task');
            return $this->redirect('/task');
        }

        $model = new TaskForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task = new Task();
            $task->title = $model->title;
            $task->description = $model->description;
            $task->status_id = 1;
            $task->author_id = Yii::$app->user->getId();
            $task->executor_id = $model->executor;
            $task->creation_date = date('Y-m-d');
            $task->deadline_date = $model->deadline;
            if($task->save()){
                Yii::$app->session->setFlash('success', 'Task created!');
                return $this->redirect('/task');
            }
            Yii::$app->session->setFlash('error', 'Error! Repeat please');
        }

        return $this->render('create', compact('model'));
    }

    public function actionView($id){
        if(!Task::findOne($id)) {
            throw new HttpException(404, 'This task could not be found');
        }

        $task = Task::findOne($id);
        $comments = Comment::findAll(['task_id' => $id]);
        $laborCosts = LaborCost::findAll(['task_id' => $id]);
        if ($task === null) {
            Yii::$app->session->setFlash('error', 'Error, task not found');
            return $this->redirect('/task');
        }
        return $this->render('view', ['task' => $task, 'comments' => $comments, 'laborCosts' => $laborCosts]);
    }

    public function actionUpdate($id){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to update task');
            return $this->redirect('/task');
        }

        if(!Task::findOne($id)) {
            throw new HttpException(404, 'This task could not be found');
        }

        $task = Task::findOne($id);
        $model = new TaskForm();
        $model->title = $task->title;
        $model->description = $task->description;
        $model->deadline = $task->deadline_date;
        $model->author = $task->author_id;
        $model->executor = User::findOne($task->executor_id)->getId();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task->title = $model->title;
            $task->description = $model->description;
            $task->deadline_date = $model->deadline;
            $task->executor_id = $model->executor;
            if ($task->save()) {
                Yii::$app->session->setFlash('success', 'Task updated!');
                return $this->redirect('/task/view/' . $id);
            }else{
                Yii::$app->session->setFlash('error', 'Some error with task updating');
            }

        }

        return $this->render('update', ['model' => $model, 'userId' => Yii::$app->user->id]);
    }

    public function actionDelete($id) {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to delete task');
            return $this->redirect('/task');
        }
        if(!Task::findOne($id)) {
            throw new HttpException(404, 'This task could not be found');
        }

        $task = Task::findOne($id);
        if($task->delete()){
            Yii::$app->session->setFlash('success', 'Task successfully deleted!');
        }else{
            Yii::$app->session->setFlash('error', 'Some error with task deleting');
        }
        return $this->redirect('/task');
    }
}