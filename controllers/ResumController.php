<?php

namespace app\controllers;

use app\models\User;
use app\models\ResumPols;
use yii\web\UploadedFile;

use yii;

class ResumController extends FunctionController
{
    public $modelClass = 'app\models\ResumPols';

    public function actionCreate(){
        $user = User::getByToken();
        $post_data=\Yii::$app->request->post();
        if (!($user && $user->isAuthorized() && $user->role != 1)) {
           return $this->send(403, ['error' => ['message' => 'Доступ запрещен']]);
       }

       $userid = $user -> id;
            $post_data=\Yii::$app->request->post();
            $phot=new ResumPols();
            $phot->load($post_data, '');
            
        $phot-> user_id =$userid;
            $phot->photo=UploadedFile::getInstanceByName('photo');
           if (!$phot->validate()) return $this->validation($phot);
            $hash=hash('sha256', $phot->photo->baseName) . '.' . $phot -> photo->extension;
            $phot->photo->saveAs(\Yii::$app->basePath. '/web/assets/upload/' . $hash);
            $phot->photo=$hash;
            $phot->save(false);
            return $this->send(204, null);
   } 



   public function actionEdit($id){
    $user = User::getByToken();
    $room = ResumPols::findOne($id);
    if($user->isAuthorized() && ($user->id == $room->user_id || $user->role==1 )){
    $request = Yii::$app->request;
    $room->load($request->bodyParams, '') ;
    $room->save(false);
    return $this -> send(204, null);
    }
    else{
        return $this->send(403,['error'=>['code'=>403, 'message'=>'Forbidden', 'errors'=>['Доступ запрещен']]]);
    }
}

public function actionDelete($id){
    $user = User::getByToken();    
    $resum=ResumPols::findOne($id);
    if(!$resum){
            return $this->send(404,['error'=>['code'=>404, 'message'=>'Not found', 'errors'=>['Резюме не найдено']]]);
    }  
    if(!$user->isAuthorized() || !($user->id == $resum->user_id || $user->role==1 )){
        return $this->send(403, ['error' => ['message' => 'Доступ запрещен']]);
    }
    
    if($resum){
        $resum -> delete();
        return $this->send(200,'нашел удалил убил');
    }
}


public function actionSearch(){
    $resum = new ResumPols;
    $resum= ResumPols::findAll(['specialization' => Yii::$app->request->get('specialization')]);
   // $room= HotelRoom::findAll(['type' => Yii::$app->request->get('type')]);
    //$room= HotelRoom::findAll(['number' => Yii::$app->request->get('number')]);
    return $this->send(200, ['data' => $resum]);
    }


    public function actionOne(){
        $resum = new ResumPols;
        $resum= ResumPols::findAll(['id' => Yii::$app->request->get('id')]);
       // $room= HotelRoom::findAll(['type' => Yii::$app->request->get('type')]);
        //$room= HotelRoom::findAll(['number' => Yii::$app->request->get('number')]);
        return $this->send(200, ['data' => $resum]);
        }

}