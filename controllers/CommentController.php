<?php


namespace app\controllers;
use app\models\Comment;
use app\models\CommentForm;
use Yii;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionCreate($taskId){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to add commentary');
            return $this->redirect('/task/index');
        }

        $model = new CommentForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $comment = new Comment();
            $comment->task_id = $taskId;
            $comment->user_id = Yii::$app->user->getId();
            $comment->text = $model->text;
            $comment->created_at = date('Y-m-d');
            if($comment->save()){
                $this->redirect('/task/view?id=' . $taskId);
            }
        }

        return $this->render('create', compact('model'));
    }
}