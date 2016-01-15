<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

class Register extends Model
{

    public $email;
    public $username;
    public $password;
    public $_password;
    public $role;

    public function rules()
    {
        return [
            [['email', 'password', 'username', 'role'], 'filter', 'filter' => 'trim'],
            [['email', 'username', 'password', '_password'], 'required'],
            ['email', 'email'],
            ['_password', 'validatePassword'],
            ['email', 'unique', 'targetClass' => User::className(),
                'message' => "Этот email уже использован. "],
            ['username', 'unique', 'targetClass' => User::className(),
                'message' => 'Этот логин уже использован.'],
        ];
    }

    public function validatePassword($attribute)
    {
        if($this->password != $this->_password)
            $this->addError($attribute, 'Пароли не совпадают. ');
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'username' => 'Логин',
            '_password' => 'Повтор пароля',
            'role' => 'Тип профиля'
        ];
    }

    public function register()
    {
        $user = new User;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->username = $this->username;
        $user->role = $this->role;
        $user->save(false);

        return $user->getPrimaryKey();
    }
}