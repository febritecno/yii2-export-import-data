<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Karyawans */

$this->title = 'Create Karyawans';
$this->params['breadcrumbs'][] = ['label' => 'Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
