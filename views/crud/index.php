<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$e=1;
?>
<style>
tr,td,th {
    padding: 10px;
}
th{
    align: center;
    font-size: 20px;
}
</style>
<h1>SIMPLE CRUD</h1>
<center>
</br>
<?= Html::a('Tambah Data', ['crud/create'], ['class' => 'btn btn-lg btn-primary']) ?>
</center>
</br>
</br>


<?php if (Yii::$app->session->hasFlash('terisi')): ?>
 <script>
 alert("Data Telah Tersimpan");
 window.location.reload();
 </script>
<?php else: ?>
       


<table border="1" align="center">
<tr>
<th>No </th>
<th>Nama </th>
<th>Alamat </th>
<th> Action</th>
</tr>
<?php foreach($a as $b): ?>
<tr>
<td><?php echo $e++;?></td>
<td><?php echo $b->nama;?></td>
<td><?php echo $b->alamat;?></td>
<td><?= Html::a('Update Data', ['crud/update','id'=>$b->id], ['class' => 'btn btn-sm btn-warning']) ?> | <?= Html::a('Hapus Data', ['crud/delete','id'=>$b->id], ['class' => 'btn btn-sm btn-danger']) ?></td>
</tr>
<?php endforeach;?>
</table>




<?php endif; ?>