<?php

namespace app\models;

use Yii;
use app\models\User;
/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property integer $age
 *
 * @property Order[] $orders
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

    public $email, $username;

    public static function tableName()
    {
        return 'profile';
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'gender', 'age'], 'required'],
            [['age'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 30],
            [['gender'], 'string', 'max' => 20]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'gender' => 'Пол',
            'age' => 'Возраст',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['profile_id' => 'id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public function createProfile($id)
    {
        $profile = new Profile;
        $profile->id = $id;
        $profile->save(false);
    }

}
