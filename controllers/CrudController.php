<?php

namespace app\controllers;
use Yii;
use app\models\Users;
use yii\web\NotFoundHttpException;
 

class CrudController extends \yii\web\Controller

{
    public function actionIndex()
    {
        $a= Users::find()
        ->orderBy('id')
        ->all();
        return $this->render('index',[
            'a' => $a
        ]);
    }

     public function actionCreate()
    {
        $a= new Users();
        if ($a->load(Yii::$app->request->post())) {
        $a->save();
        Yii::$app->session->setFlash('terisi');
            return $this->redirect(['index']);
        }
        return $this->render('create',[
            'a'=> $a
        ]);
    }

     public function actionUpdate($id)
    {
        $a = Users::find()->where(['id' => $id])->one();
 
        if($a === null)
            throw new NotFoundHttpException('The requested page does not exist.');
         
        // update record
        if($a->load(Yii::$app->request->post()) && $a->save()){
            return $this->redirect(['index']);
        }
         
        return $this->render('update', ['a' => $a]);
    }

     public function actionDelete($id)
    {
       $model = Users::findOne($id);
         
        // $id not found in database
        if($model === null)
            throw new NotFoundHttpException('The requested page does not exist.');
             
        // delete record
        $model->delete();
         
        return $this->redirect(['index']);
    }

}
