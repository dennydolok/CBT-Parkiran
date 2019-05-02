<!DOCTYPE html>
<html lang="en">
<head>
	<title>Input Pengendara</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--Data Tables-->
	<link rel="stylesheet" type="text/css" href="../../asset/asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../asset/asset/css/dataTables.bootstrap4.min.css">
</head>
<body>

<?php 
	include "../../config/koneksi.php";
	date_default_timezone_set("Asia/Jakarta");
	session_start();
	$kd_parkir = "SS" . rand(001,200);

	$query = mysqli_query($con, "SELECT * FROM tbl_pengendara WHERE status = 'ada'");
	$cek_isi = mysqli_num_rows($query);
	$cek_sisa = 200-$cek_isi;
	$jumlah_jam = date('H');

	if (isset($_POST['simpan'])) {
		$no_kendaraan = $_POST['no_kendaraan'];
		$jenis_kendaraan = $_POST['jenis_kendaraan'];
		$jam_masuk = date('H:i');
		$hitung_jam_masuk = date('H');

   	$select_isi = mysqli_num_rows($query);
  	if ($select_isi >= 200) {
    	echo "<script>alert('Parkiran Sudah Penuh')</script>";
  	}
  	else{
    	$sisa = 200 - @$seleksi_isi;
    	$cek_kode = mysqli_num_rows(mysqli_query($con, "SELECT kd_parkir FROM tbl_pengendara WHERE kd_parkir='$kd_parkir' AND status = 'ada'"));
    	$cek_plat = mysqli_num_rows(mysqli_query($con, "SELECT no_kendaraan FROM tbl_pengendara WHERE no_kendaraan='$no_kendaraan' AND status = 'ada'"));

    if($cek_kode>=1) {
      	$kd_parkir = "SS" . rand(001,200);
    }elseif ($cek_plat>=1) {
      	echo "<script>alert('Kendaraan Tersebut Sudah Ada di Dalam Parkiran')</script>";
    }else{
    	$namajaga =  $_SESSION['kd_jaga'];
      	$sql = mysqli_query($con, "INSERT INTO tbl_pengendara(no_kendaraan, kd_parkir, jenis_kendaraan, jam_masuk, status, jumlah_jam, kd_penjaga) VALUES('$no_kendaraan', '$kd_parkir', '$jenis_kendaraan', '$jam_masuk', 'ada', '$jumlah_jam', '$namajaga')");
      	$query = mysqli_query($con, "INSERT INTO tbl_parkiran VALUES('$kd_parkir', 'ada', '$jenis_kendaraan')");        
      	echo "<script>alert('data tersimpan');document.location.href='../../print.php?no_kendaraan=$no_kendaraan'</script>";
    }
  }
}
	if (isset($_POST['keluar'])) {
  		$kd_parkir = $_POST['kode_parkir'];
  		$query = mysqli_query($con, "SELECT * FROM tbl_pengendara WHERE kd_parkir = '$kd_parkir' AND status = 'ada'");
  		$update = mysqli_query($con, "UPDATE tbl_parkiran SET status = 'selesai' WHERE kd_parkir = '$kd_parkir'");
  		$data = mysqli_num_rows($query);
  		if ($data = 'ada') {
    	echo "<script>document.location.href='../../keluar.php?kd_parkir=$kd_parkir'</script>";
  	}else{
    	echo "<script>alert('Kode Yang Anda Masukan Tidak Tersedia !');document.location.href='index.php?'</script>";
  	}
  
}
 ?>
	<div class="container-contact100">

		<div class="wrap-contact100" style="margin-top:40px;">
			<form class="contact100-form" method="POST">
				<span class="contact100-form-title">
					Input Data Pengendara
				</span>

				<div class="wrap-input100 validate-input" data-validate="Input Nomor Kendaraan">
					<input class="input100" type="text" name="no_kendaraan" placeholder="Nomor Kendaraan" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Input Jenis Kendaraan">
					<select class="input100" name="jenis_kendaraan" placeholder = "Jenis Kendaraan" required style="border: none;">
						<option></option>
						<option>Motor</option>
						<option>Mobil</option>
						<option>Lainnya</option>
					</select>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button type="submit" class="contact100-form-btn" name="simpan">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true" ></i>
							Masuk
						</span>
					</button>
				</div>
			</form>
		</div>

		<div class="wrap-contact100" style="margin-left: 13px;">
			<form method="POST" class="contact100-form">
				<span class="contact100-form-title">
					Keluar???
				</span>

				<div class="wrap-input100 validate-input" data-validate="Masukan Kode Parkir">
					<input class="input100" type="text" name="kode_parkir" placeholder="Masukan Kode" required>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button type="submit" class="contact100-form-btn" name="keluar">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Next
						</span>
					</button>
				</div>
			</form>
		</div>			

		<center>
		<table id="example" class="table table-striped table-bordered" border="1" cellspacing="0" width="100%">
			<thead>
				<tr>
					<td><b>Nomor Kendaraan</b></td>
					<td><b>Kode Parkir</b></td>
					<td><b>Jenis Kendaraan</b></td>
					<td><b>Jam Masuk</b></td>
					<td><b>Status</b></td>
				</tr>
			</thead>

			<tbody>
			<?php 
				$sql = "SELECT * FROM tbl_pengendara WHERE status = 'ada'";
  				$query = mysqli_query($con, $sql);

  				while ($data = mysqli_fetch_array($query)) {
			?>
				<tr>
					<td><?php echo $data['no_kendaraan']?></td>
					<td><?php echo $data['kd_parkir']?></td>
					<td><?php echo $data['jenis_kendaraan']?></td>
					<td><?php echo $data['jam_masuk']?></td>
					<td><?php echo $data['status']?></td>
				</tr>
			<?php } ?>	
			</tbody>
		</table>
	</center>

	</div>			
	
	<div id="dropDownSelect1"></div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<script src="../../asset/asset/js/jquery-1.12.4.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$('#example').DataTable();
	});
</script>
<script src="../../asset/asset/js/jquery.dataTables.min.js"></script>
<script src="../../asset/asset/js/dataTables.bootstrap4.min.js"></script>

</body>
</html>
