<?php
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

    <?php $form=ActiveForm::begin([
         'options' => ['enctype' => 'multipart/form-data']  
    ]);?>

    <?= $form->field($model,'nama');?>
    <?= $form->field($model,'file')->fileInput();?>

    <div class='form-group'>
         <?= Html::submitButton('Submit', ['class'=> 'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>

    </br>

    <?php if ($model ->file_id): ?>

    <div class='form-group'>
    <h4> Result Dari Upload: </h4>
    
    <?= Html::img(['/file' , 'id'=> $model->file_id],['target']=> 'blank')?>
    
    <?php endif; ?>