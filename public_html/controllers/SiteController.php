<?php

namespace app\controllers;

use app\models\SendEmail;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Register;
use app\models\Profile;
use app\models\User;
use app\models\Recover;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionRegister()
    {
        $model = new Register();
        $profile = new Profile();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($id = $model->register()) {
                    $profile->createProfile($id);
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRecover()
    {
        $isRecovered = false;
        $sendModel = new SendEmail();
        $recoverModel = new Recover();

        if($sendModel->load(Yii::$app->request->post()))
        {
            if($sendModel->validate())
            {
                if($sendModel->sendEmail()) {
                    Yii::$app->session->setFlash('success', 'Секретный код отправлен на указанный email. ');

                }
            }
        }

        if($recoverModel->load(Yii::$app->request->post()))
        {
            if($recoverModel->validate())
            {
                if($recoverModel->recover()) {
                    $isRecovered = true;
                    Yii::$app->session->setFlash('success', 'Ваш пароль успешно изменён. ');
                    return $this->goHome();
                }
            }
        }

        return $this->render('recover', ['sendModel' => $sendModel, 'recoverModel' => $recoverModel,
            'isRecovered' => $isRecovered]);
    }

    public function actionLogout()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        $user->removeAccessToken();
        $user->save(false);
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }
}
