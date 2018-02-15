<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <style>
        .page
        {           
            padding:2cm;
        }
        table
        {
            border-spacing:0;
            border-collapse: collapse; 
            width:100%;
        }
        table td, table th
        {
            border: 1px solid #ccc;
        }
		
		table th
        {
            background-color:red;
        }
    </style>
</head>
<body>	
    <div class="page">	
        <h1>Table Karyawan</h1>
        <table border="0">
        <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telpon</th>
                <th>status</th>
        </tr>
        <?php
        $no = 1;
        foreach($dataProvider->getModels() as $karyawan){ 
        ?>
        <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $karyawan->nama ?></td>
                <td><?php echo $karyawan->alamat ?></td>
                <td><?php echo $karyawan->telpon ?></td>
                <td><?php echo $karyawan->status ?></td>
        </tr>
        <?php
        }
        ?>
        </table>
    </div>   
</body>
</html>