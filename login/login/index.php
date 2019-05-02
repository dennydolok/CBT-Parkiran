<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
<?php 
	include "../../config/koneksi.php";

	date_default_timezone_set("Asia/Jakarta");
	$waktu = date('H:i');
	$tanggal = date('D, d M Y');
	$jam = date('H');
	if (isset($_POST['login_admin'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);

		if (($row['username'] == $username) AND ($row['password'] == $password)) {
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			if ($row['shift'] == '1') {
				if ($jam >= 6 && $jam <= 11) {
					echo "<script>alert('selamat datang');document.location.href = '../../admin.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}if ($row['shift'] == '2') {
				if ($jam >= 12 && $jam <= 17) {
					echo "<script>alert('selamat datang');document.location.href = '../../admin.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}if ($row['shift'] == '3') {
				if ($jam >= 18 && $jam <= 22) {
					echo "<script>alert('selamat datang');document.location.href = '../../admin.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}
			
		}else{
			echo "<script>alert('password dan username salah');document.location.href='index.php';</script>";
		}
	}

if (isset($_POST['login_petugas'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM tbl_penjaga WHERE username='$username' AND password = '$password'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);

		if (($row['username'] == $username) AND ($row['password'] == $password)) {
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['penjaga'] = $row['nama_penjaga'];
			$_SESSION['kd_jaga'] = $row['kd_penjaga'];
			if ($row['shift'] == '1') {
				if ($jam >= 6 && $jam <= 11) {
					echo "<script>alert('selamat datang');document.location.href = '../../pengendara/pengendara/index.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}if ($row['shift'] == '2') {
				if ($jam >= 12 && $jam <= 17) {
					echo "<script>alert('selamat datang');document.location.href = '../../pengendara/pengendara/index.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}if ($row['shift'] == '3') {
				if ($jam >= 18 && $jam <= 22) {
					echo "<script>alert('selamat datang');document.location.href = '../../pengendara/pengendara/index.php'</script>";
				}else{
					echo "<script>alert('Bukan jam kerja anda');document.location.href=''</script>";
				}
			}
		}else{
			echo "<script>alert('password dan username salah');document.location.href='index.php';</script>";
		}
	}
 ?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-26">
						ParkiranKu

					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Input Username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Input Password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login_admin">
								Admin
							</button>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login_petugas">
								Petugas
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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

</body>
</html>