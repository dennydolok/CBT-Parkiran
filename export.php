<?php 
	$tanggal = date('d-m-Y');

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment: filename=$tanggal-datasiswa.xls");

	include 'index.php';
 ?>