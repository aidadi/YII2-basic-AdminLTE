<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegistrationForm;
use yii\helpers\Url;
use yii\filters\AccessControl;

class RegistrationController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new RegistrationForm();

        $RegMessage = false;

        if ($model->load(Yii::$app->request->post()) && $model->registration()) {
            Yii::$app->session->setFlash('RegMessage', "Регистрация прошла успешно!");
            $this->redirect(Url::to(['/registration']), 302)->send();
            return;
        }

        if (Yii::$app->session->hasFlash('RegMessage')) {
            $RegMessage = Yii::$app->session->getFlash('RegMessage');
        }

        return $this->render('index', [
            'model' => $model,
            'RegMessage' => $RegMessage,
        ]);
    }
}