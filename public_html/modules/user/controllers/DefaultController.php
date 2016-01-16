<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['profile/index'], 301);
    }
}
