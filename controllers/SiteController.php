<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\base\DynamicModel;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'only' => ['about'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->IsGuest){
        $kata= "Telah Ter Login";
        }else{
        $kata="Anda Harus Login "; 
        }
        return $this->render('index',[
            'kata'=>$kata
        ]);
    }

   public function actionUpload()
    {
        $model = new DynamicModel([
            'nama', 'file_id'
            ]);
    
        // behavior untuk upload file
        $model->attachBehavior('upload', [
            'class' => 'mdm\upload\UploadBehavior',
            'attribute' => 'file',
            'savedAttribute' => 'file_id' // coresponding with $model->file_id
        ]);
    
        // rule untuk model
        $model->addRule('nama', 'string')
            ->addRule('file', 'file', ['extensions' => 'jpg']);
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveUploadedFile() !== false) {
                Yii::$app->session->setFlash('success', 'Upload Sukses');
            }
        }
        return $this->render('upload',['model' => $model]);
    }

    


     public function actionDaftar()
     {
        $model = new User();
        

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
    }

    return $this->render('daftar', [
        'model' => $model,
    ]);
    }


    public function actionHallo()
    {
        $halaman1 = "Hallo Halaman 1";
        $halaman2 = "Hallo Halaman 2";
        $halaman3 = "Hallo Halaman 3";
        $hallo= "hallo yii 2";
        return $this->render('hello',[
            'hallo' => $hallo,
            'halaman1' => $halaman1,
            'halaman2' => $halaman2,
            'halaman3' => $halaman3
        ]);
    }
    public function actionHalaman1()
    {
        return $this->render('halaman1');
    }

      public function actionHalaman2()
    {
        return $this->render('halaman2');
    }
      public function actionHalaman3()
    {
        return $this->render('halaman3');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        
        

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
