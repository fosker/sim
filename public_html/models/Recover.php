<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


class Recover extends Model
{
    public $newPassword;
    public $_password;
    public $secret_key;

    public function rules()
    {
        return [
            [['newPassword', '_password', 'secret_key'], 'required'],
            [['newPassword', '_password', 'secret_key'], 'filter', 'filter' => 'trim'],
            ['_password', 'validatePassword'],
            ['secret_key', 'validateSecretKey'],
        ];
    }

    public function validatePassword($attribute)
    {
        if($this->newPassword != $this->_password)
            $this->addError($attribute, 'Пароли не совпадают. ');
    }

    public function validateSecretKey($attribute)
    {
        $user = User::findOne(
            [
                'email' => Yii::$app->session['recoverEmail']
            ]
        );
        if($this->secret_key != $user->secret_key)
            $this->addError($attribute, 'Неправильный секретный код. ');
    }


    public function attributeLabels()
    {
        return [
            'newPassword' => 'Ваш новый пароль',
            '_password' => 'Повторите новый пароль',
            'secret_key' => 'Секретный код'
        ];
    }

    public function recover()
    {
        $user = User::findOne(
            [
                'email' => Yii::$app->session['recoverEmail']
            ]
        );
        $user->setPassword($this->newPassword);
        $user->removeSecretKey();
        if($user->save(false)) {
            Yii::$app->session['sendRecoverEmail'] = false;
            return true;
        } else
            return false;
    }
}
