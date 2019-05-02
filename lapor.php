<?php 
include 'config/controllers.php';
include 'library/oop.php';
$table = 'lapor';
$perintah = new oop();
 ?>
 <<!DOCTYPE html>
 <html>
 <head>
 </head>
 <body>
 <a href="#" onclick="window.print()">Print</a>

<h1>Laporan Data Siswa</h1>
<table>
   <tr>
        <td>Nomor</td>
        <td>Kode Parkir</td>
	   <td>No Kendaraan</td>
	   
	   <td>Jenis Kendaraan</td>
	   <td>Jam Masuk</td>
	   <td>Nama Penjaga</td>
   </tr>
   <?php
        $sql = "SELECT * FROM laporan";
        $query = mysqli_query($con, "SELECT * FROM laporan");
        
	   $no = 0;
       while ($data = mysqli_fetch_array($query)) 
       $no++;
       {
		
   ?>
   <tr>
   <td><?php echo $no?></td>
   <td><?php  echo @$data[0];?></td>
   <td><?php  echo @$data[1];?></td>
   <td><?php  echo @$data[2]?></td>
   <td><?php  echo @$data[3];?></td>
   <td><?php  echo @$data[5];?></td>
   </tr>
	   <?php }?>
</table>	
 </body>
 </html>