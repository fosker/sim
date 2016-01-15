<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


class SendEmail extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
                'message' => 'Данный email не зарегистрирован. '
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
        ];
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne(
            [
                'email' => $this->email
            ]
        );
        Yii::$app->session['recoverEmail'] = $this->email;

        if($user):
            $user->generateSecretKey();
            if($user->save(false)):
                Yii::$app->session['sendRecoverEmail'] = true;
                return Yii::$app->mailer->compose('resetPassword', ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name.'(отправлено автоматически)'])
                    ->setTo($this->email)
                    ->setSubject('Восстановление пароля для '.Yii::$app->name)
                    ->send();
            endif;
        endif;

        return false;
    }
}
