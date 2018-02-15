<?php

namespace app\controllers;
use yii;
use app\models\Karyawan;

class KaryawanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data=Karyawan::find()
        ->orderBy('id')
        ->all();
        $info="<script>alert('Data Kosong');</script><center><h1>DATA KOSONG PADA DATABASE</h1></center>";
        return $this->render('index',[
            'data'=> $data,
            'info'=> $info
        ]);
    }

    public function actionCreate()
    {
        $data=new Karyawan();
        if ($data->load(Yii::$app->request->post()))
        {
            $data->save();
            return $this->redirect(['index']);
        }
        return $this->render('create',['data'=>$data]);
    }

    public function actionUpdate($id)
    {
        $data=Karyawan::find()
        ->where(['id'=>$id])
        ->one();

        if ($data->load(Yii::$app->request->post()))
        {
            $data->save();
            return $this->redirect(['index']);
        }
        return $this->render('update',[
            'data' => $data
        ]);
    }

    public function actionDelete($id)
    {
        $data=Karyawan::findOne($id);
        $data->delete();
        return $this->redirect(['index']);
    }

    

}
