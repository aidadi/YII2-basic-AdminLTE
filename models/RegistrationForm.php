<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $username, $password, $repassword;

    public function rules()
    {
        return [
            [
             'username',
             'required',
             'message' => 'Введите E-mail!'
            ],
            [
             'username',
             'email',
             'message' => 'Некорректный E-mail!',
            ],
            [
             'username',
             'unique',
             'targetClass' => User::className(),
             'message' => 'Пользователь с таким Email уже зарегистрирован!',
            ],
            [
             'password',
             'required',
             'message' => 'Введите пароль!',
            ],
            [
             'repassword',
             'required',
             'message' => 'Повторите ввод пароля!'
            ],
            [
             'password',
             'string',
             'min' => 6,
             "message" => 'Пароль должен содержать не менее 6-и символов!'
            ],
            [
             'repassword',
             'validateRepassword'
            ],
        ];
    }

    public function validateRepassword($attribute, $params) {
        if ($this->password != $this->repassword) {
            $this->addError($attribute, 'Пароли не совпадают!');
        }
    }

    public function registration() {
        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->authkey = Yii::$app->security->generatePasswordHash($user->username);
            $user->save();

            return true;
        }

        return false;
    }
}