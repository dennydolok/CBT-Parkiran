<?php 
	include 'config/koneksi.php';
	include 'index.php';
	$a = date('d-m-Y');
	$b = date('H:i:s');

	echo "Tanggal : $a <br/>";
	echo "Jam : $b";
 ?>

 <p><a href="export.php"><button>Export Data Ke Excel</button></a></p>