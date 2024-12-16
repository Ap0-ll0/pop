<?php

namespace app\controllers;

use app\models\User;
use app\models\LoginForm;

use yii;

class UserController extends FunctionController
{
    public $modelClass = 'app\models\User';

    public function actionCreate()
    {
        $data=Yii::$app->request->post();
        $user=new User();
        $user->load($data, '');
        if (!$user->validate()) return $this -> validation($user);
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $user->token = Yii::$app->getSecurity()->generateRandomString();
        $user->save();
        return $this->send(204,null);
    }



    public function actionLogin(){
        $data=Yii::$app->request->post();
        // $user=new User();
        $login_data=new LoginForm();
        $login_data->load($data, '');
        
       if (!$login_data->validate()) return $this->validation($login_data);
        $user=User::find()->where(['username'=>$login_data->username])->one();
        if (!is_null($user)) {
        if (\Yii::$app->getSecurity()->validatePassword($login_data->password, $user->password)) {
        $token = \Yii::$app->getSecurity()->generateRandomString();
        $user->token = $token;
        $user->save(false); //false — произвести запись без валидации
        $data = ['data' => ['token' => $token]];
        return $this->send(200, $data);
        }
        }
        return $this->authorization($login_data);
        }

        public function actionKabinet(){
            $user = User::getByToken();
            if ($user && $user->isAuthorized()) {
                return $this->send(200, ['data' => User::find()->where(['token'=>$user['token']])->one()]);
            }
            return $this->send(401, ['error' => ['message' => 'Вы не авторизованы']]);
        }



    public function actionEmail(){
        $user = User::getByToken();
        $new_user = new User(['scenario' => User::SCENARIO_UPDATE_EMAIL]);
        if($user && $user->isAuthorized()){
            $user = User::find()->where(['token'=>$user['token']])->one();
            $email = Yii::$app->request->getBodyParam('email');
            $new_user -> email = $email;
            if(!$new_user->validate()){
            return $this->validation($user);
            }
            $user -> email = $email;
            $user->update(false);
            return $this->send(204,null);
        }
            return $this->send(401, ['error'=>['code'=>401, 'message'=>'Unauthorized', 'errors'=>['email'=>'Неверный email или пароль']]]);
        }



    public function actionPhone(){
        $user = User::getByToken();
        $new_user = new User(['scenario' => User::SCENARIO_UPDATE]);
        if($user && $user->isAuthorized()){
            $user = User::find()->where(['token'=>$user['token']])->one();
            $phone = Yii::$app->request->getBodyParam('phone');
            $new_user -> phone = $phone;
            if(!$new_user->validate()){
            return $this->validation($user);
            }
            $user -> phone = $phone;
            $user->update(false);
            return $this->send(204,null);
        }
            return $this->send(401, ['error'=>['code'=>401, 'message'=>'Unauthorized', 'errors'=>['email'=>'Неверный phone']]]);
        }



}