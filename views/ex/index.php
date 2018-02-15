<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


     <?php $form=ActiveForm::begin([
          
          'options' => ['enctype' => 'multipart/form-data'],
          'action' => ['import']

     ]);?>

     <?= $form->field($modelImport, 'fileImport')-> fileInput() ?>

        <div class='form-group'>
             <?= Html::submitButton('Import Excel', ['class' =>'btn btn-warning'])?>
        </div>



     <?php ActiveForm::end(); ?>
