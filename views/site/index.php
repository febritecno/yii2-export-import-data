<?php

use yii\helpers\Html;
?>

<?php


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo $kata;?></h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

		<?= Html::a('COBA EXPORT/IMPORT','index.php?r=karyawan',['class'=>'btn btn-primary btn-lg']); ?>

    </div>
</div>
