<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawans */
/* @var $form ActiveForm */
?>
<div class="form-karyawan">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'telpon') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'nama') ?>
        <?= $form->field($model, 'alamat') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- form-karyawan -->
