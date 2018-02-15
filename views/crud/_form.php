<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>  

  <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($a, 'nama')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($a, 'alamat')->textarea(['rows' => 5]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

