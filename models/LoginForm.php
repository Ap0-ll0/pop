<?php
namespace app\models;
use Yii;
use yii\base\Model;


class LoginForm extends Model
{
    public $username;
    public $password;
 /**
 * @return array the validation rules.
 */

 public function rules()
 {
    return [
        [[ 'username', 'password'], 'required'],
        ['username', 'match', 'pattern' => '/^[a-z]+$/iu', 'message'=>'Введен неверный или некорректное имя пользователя'],
        ['password', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*[\d])(?=.*[a-z])(?=.*[\W])[a-zA-Z\d\W]{6,20}+$/iu', 'message'=>'Введен неверный или неккоректный пароль'],
        [['username'], 'string', 'max' => 255],

    ];
 }
 public function attributeLabels()
 {
     return [
         'username' => 'username',
         'password' => 'password',
     ];
 }
}