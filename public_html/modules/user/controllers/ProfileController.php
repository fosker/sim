<?php

namespace app\modules\user\controllers;

use Yii;
use app\models\Profile;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }


    public function actionUpdate()
    {
        $model = $this->findModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete()
    {
        $this->findModel()->delete();

        return $this->redirect(['index']);
    }

    protected function findModel()
    {
        if ($model = Profile::findOne(Yii::$app->user->identity->getId())) {
            $model->username = $model->user->username;
            $model->email = $model->user->email;
            $model->role = $model->user->role;
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
