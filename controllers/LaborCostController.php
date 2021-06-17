<?php


namespace app\controllers;
use app\models\LaborCost;
use app\models\LaborCostForm;
use yii\web\Controller;
use Yii;

class LaborCostController extends Controller
{
    public function actionCreate($taskId){
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('info', 'You should login to add labor cost');
            return $this->redirect('/task/view?id=' . $taskId);
        }

        $model = new LaborCostForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $laborCost = new LaborCost();
            $laborCost->task_id = $taskId;
            $laborCost->user_id = Yii::$app->user->getId();
            $laborCost->time = date('H:i', strtotime($model->time));
            $laborCost->comment = $model->comment;
            if($laborCost->save()){
                return $this->redirect('/task/view?id=' . $taskId);
            }
        }

        return $this->render('create', compact('model'));
    }
}