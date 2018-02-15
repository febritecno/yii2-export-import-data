<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php
$form = ActiveForm::begin(); ?>

<?= $form->field($data,'nama')->TextInput()?>
<?= $form->field($data,'alamat')->TextArea()?>
<?= $form->field($data,'telpon')->Input('integer',['maxlength'=>15])?>
<?= $form->field($data,'status')->dropDownList([['Pilih status'],'0'=>'Aktif','1'=>'Tidak Aktif'])?>

<div class="form-group">
<?= Html::SubmitButton('Kirim',['class'=>'btn btn-primary']);?>
</div>



<?php ActiveForm::end(); ?>