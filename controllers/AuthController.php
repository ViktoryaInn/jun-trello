<?php


namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use Yii;
use app\models\LoginForm;
use yii\web\Controller;


class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('success', 'You are already authorized');
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'You are enter to jun-Trello');
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'You are exit from jun-Trello');
        return $this->goHome();
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->login = $model->login;
//            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->created_at = date("Y-m-d");
            if($user->save()){
                Yii::$app->session->setFlash('success', 'You are registered');
                return $this->goHome();
            }
        }

        return $this->render('signup', compact('model'));
    }
}