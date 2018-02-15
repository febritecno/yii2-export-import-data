<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$i=1;
?>

<style>
tr,td{
    padding:10px;
}
</style>

<h1>Data Karyawan</h1>

</br>
  <!--contoh splash notif flash-->
       <?php
           if (Yii::$app->session->hasFlash('success'))
           {
              echo '<div class="alert alert-success">';
              echo  Yii::$app->session->getFlash('success');
              echo '</div>';
              
           }else if(Yii::$app->session->hasFlash('error'))
           {
                
              echo '<div class="alert alert-danger">';
              echo  Yii::$app->session->getFlash('error');
              echo '</div>';
           }
       ?>
<center>
<p>
    <!--contoh komponen link-->
    <?= Html::a('Tambah Data',['karyawan/create'],['class'=>'btn btn-primary btn-lg']); ?>
    <?= Html::a('Import Excel','index.php?r=ex',['class'=>'btn btn-warning btn-lg']); ?>
    <?= Html::a('Export Word','index.php?r=ex/word',['class'=>'btn btn-primary btn-lg']); ?>
    <?= Html::a('Export PDF','index.php?r=ex/pdf',['class'=>'btn btn-danger btn-lg']); ?>
    <?= Html::a('Export Excel','index.php?r=ex/excel',['class'=>'btn btn-warning btn-lg']); ?>
</p>
</center>

</br>
</hr>
</br>

<table border ="1" align="center">
    <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Telfon</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
<?php foreach($data as $datakecil):?>
    <tr>
    <td><?php echo $i++ ;?></td>
    <td><?php echo $datakecil-> nama;?></td>
    <td><?php echo $datakecil-> alamat;?></td>
    <td><?php echo $datakecil-> telpon;?></td>
    <td><?php 
    if ($datakecil-> status) {
       echo "Aktif";
    }else{
        echo "Tidak Aktif";
    }
    ?></td>
    <td><?= Html::a('Update Data',['karyawan/update','id'=>$datakecil->id],['class'=>'btn btn-warning btn-sm']); ?> | <?= Html::a('Delete Data',['karyawan/delete','id'=>$datakecil->id],['class'=>'btn btn-danger btn-sm']); ?></td>
    </tr>
<?php endforeach;?>
</table>
<?php
   if ($data==null)
   {
       echo $info;
   }
?>
