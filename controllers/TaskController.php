<?php


namespace app\controllers;

use app\models\Comment;
use app\models\Status;
use app\models\TaskSearchModel;
use app\models\User;
use Yii;
use app\models\Task;
use app\models\TaskForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;


class TaskController extends Controller
{
    public function actionIndex(){
        $searchModel = new TaskSearchModel();
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
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

    public function actionTaskFilter(){
        $filter = Yii::$app->request->get('filter');
        $name = Yii::$app->request->get('name');

        $tasks = [];

        if($filter == 'status'){
            $statusId = Status::find()->where(['name' => $name])->one();
            $tasks = Task::find()->where(['status_id' => $statusId])->all();
        }else if($filter == 'author'){
            $userId = User::findByUsername($name)->id;
            $tasks = Task::find()->where(['author_id' => $userId])->all();
        }else if($filter == 'executor'){
            $userId = User::findByUsername($name)->id;
            $tasks = Task::find()->where(['executor_id' => $userId])->all();
        }

        $statuses = Status::find()->all();
        $users = User::find()->all();

        return $this->render('index', [
            'statuses' => $statuses,
            'users' => $users,
            'tasks' => $tasks
        ]);
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
            $task->creation_date = date('Y-m-d');
            $task->deadline_date = $model->deadline;
            if($task->save()){
                Yii::$app->session->setFlash('success', 'Task created!');
                return $this->redirect('/task/index');
            }
            Yii::$app->session->setFlash('error', 'Error! Repeat please');
        }

        return $this->render('create', compact('model'));
    }

    public function actionView($id){
        $task = Task::findOne($id);
        $comments = Comment::findAll(['task_id' => $id]);
        if ($task === null) {
            Yii::$app->session->setFlash('error', 'Ошибка. Такое задание не найдено');
            return $this->redirect('/task/index');
        }
        return $this->render('view', ['task' => $task, 'comments' => $comments]);
    }

    public function actionUpdate($id){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to update task');
            return $this->goHome();
        }

        $task = Task::findOne($id);
        $model = new TaskForm();
        $model->title = $task->title;
        $model->description = $task->description;
        $model->deadline = $task->deadline_date;
        $model->author = $task->author_id;
        $model->executor = User::findOne($task->executor_id);
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task->title = $model->title;
            $task->description = $model->description;
            $task->deadline_date = $model->deadline;
            $task->executor_id = $model->executor;
            if ($task->save()) {
                Yii::$app->session->setFlash('success', 'Task updated!');
                return $this->redirect('/task/index');
            }
        }

        return $this->render('update', ['model' => $model, 'userId' => Yii::$app->user->id]);
    }

    public function actionDelete($id) {
        $task = Task::findOne($id);
        $task->delete();
        Yii::$app->session->setFlash('info', 'Task successfully deleted!');
        return $this->redirect('/task/index');
    }
}