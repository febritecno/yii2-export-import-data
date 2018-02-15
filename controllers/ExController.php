<?php

namespace app\controllers;
use Yii;
use app\models\Karyawans;
use app\models\Karyawan;
use app\models\KaryawansCari;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;

class ExController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $searchModel = new KaryawansCari();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $field = [
            'fileImport' => 'File Import',
        ];
        $modelImport = DynamicModel::validateData($field, [
            [['fileImport'], 'required'],
            [['fileImport'], 'file', 'extensions'=>'xls,xlsx','maxSize'=>1024*1024],
        ]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelImport' => $modelImport,
        ]);
    }


     protected function findModel($id)
    {
        if (($model = Karyawans::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
	/*
	IMPORT WITH PHPEXCEL
	*/ 	
    public function actionImport()
    {
        $field = [
            'fileImport' => 'File Import',
        ];
        
        $modelImport = DynamicModel::validateData($field, [
            [['fileImport'], 'required'],
            [['fileImport'], 'file', 'extensions'=>'xls,xlsx','maxSize'=>1024*1024],
        ]);
        if (Yii::$app->request->post()) {
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
            if ($modelImport->fileImport && $modelImport->validate()) {                                
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName );
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $baseRow = 5;
                while(!empty($sheetData[$baseRow]['A'])){
                    $model = new Karyawans();
                    $model->nama = (string)$sheetData[$baseRow]['B'];
                    $model->alamat = (string)$sheetData[$baseRow]['C'];
                    $model->telpon = (string)$sheetData[$baseRow]['D'];
                    $model->status = (string)$sheetData[$baseRow]['E'];
                    $model->save(); 
                    //die(print_r($model->errors));
                    $baseRow++;
                }
                Yii::$app->getSession()->setFlash('success', 'Data Berhasil Di Import');
            }
            else{
                Yii::$app->getSession()->setFlash('error', 'Data Gagal Di Import');
            }
        }
        
        return $this->redirect('index.php?r=karyawan');
    }
    

    public function actionPdf()
    {
        $searchModel = new KaryawansCari();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $html = $this->renderPartial('_pdf',['dataProvider'=>$dataProvider]);
        $mpdf=new \mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);  
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function actionExcel()
    {
        $searchModel = new KaryawansCari();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // Initalize the TBS instance
        $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
        // Change with Your template kaka
		$template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/ms-excel.xlsx';
        $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
        //$OpenTBS->VarRef['modelName']= "Mahasiswa";				
        $data = [];
        $no=1;
        foreach($dataProvider->getModels() as $karyawan){
            $data[] = [
                'no'=>$no++,
                'nama'=>$karyawan->nama,
                'alamat'=>$karyawan->alamat,
                'telpon'=>$karyawan->telpon,
                'status'=>$karyawan->status,
            ];
        }
        
        $data2[0] = [
                'no'=>'A',
                'nama'=>'B',
                'alamat'=>'C',
                'telpon'=>'D',
                'status'=>'E',
            ];

        $OpenTBS->MergeBlock('data', $data);
        $OpenTBS->MergeBlock('data2', $data2);
        // Output the result as a file on the server. You can change output file
        $OpenTBS->Show(OPENTBS_DOWNLOAD, 'export.xlsx'); // Also merges all [onshow] automatic fields.			
        exit;
    }

    public function actionWord()
    {
        $searchModel = new KaryawansCari();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // Initalize the TBS instance
        $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
        // Change with Your template kaka
		$template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/ms-word.docx';
        $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
        //$OpenTBS->VarRef['modelName']= "Mahasiswa";				
        $data = [];
        $no=1;
        foreach($dataProvider->getModels() as $karyawan){
            $data[] = [
                'no'=>$no++,
                 'nama'=>$karyawan->nama,
                'alamat'=>$karyawan->alamat,
                'telpon'=>$karyawan->telpon,
                'status'=>$karyawan->status,
            ];
        }
        $OpenTBS->MergeBlock('data', $data);
        // Output the result as a file on the server. You can change output file
        $OpenTBS->Show(OPENTBS_DOWNLOAD, 'export.docx'); // Also merges all [onshow] automatic fields.			
        exit;
    } 
}
