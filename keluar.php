<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>ParkiranKu</title>
 <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
 <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>

 <link href="asset/css/style.css" rel="stylesheet">

 <link rel="shortcut icon">

</head>

<?php
include 'config/koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$username = @$_GET['nama'];
$kode_keluar = $_GET['kd_parkir'];
$jam_keluar = date('H:i');

$query = mysqli_query($con, "SELECT * FROM tbl_pengendara WHERE kd_parkir = '$kode_keluar' AND status = 'ada'");
$data = mysqli_fetch_array($query);

$masuk = $data['jumlah_jam'];
$keluar = date('H');

if ($keluar == $masuk) {
  $lama = 1;
}else if ($keluar > $masuk){
  $lama = $keluar - $masuk;
}else{
  $keluar = $keluar + 24;
  $lama = $keluar - $masuk;
}

if($data['jenis_kendaraan'] == "Motor"){
  $hasil = 1000 * $lama;
}elseif ($data['jenis_kendaraan'] == "Mobil") {
  $hasil = 2000 * $lama;
}elseif ($data['jenis_kendaraan'] == "Lainnya") {
  $hasil = 3000 * $lama;
}

if (isset($_POST['btn_hitung'])) {
  $bayar = $_POST['bayar'];

  if ($bayar >= $hasil) {
    $kembali = $bayar - $hasil; 
    if ($kembali == 0) {
      $query = mysqli_query($con, "UPDATE tbl_pengendara SET status = 'selesai', jam_keluar = '$jam_keluar' WHERE kd_parkir = '$kode_keluar'");
      echo "<script>alert('Terima Kasih...');document.location.href='pengendara/pengendara/index.php?nama=$username'</script>";
    }
  }else{
    echo "<script>alert('Uang Anda Kurang');</script>";
  }
}

if (isset($_POST['btn_back'])) {
  $query = mysqli_query($con, "UPDATE tbl_pengendara SET status = 'selesai', jam_keluar = '$jam_keluar' WHERE kd_parkir = '$kode_keluar'");
  echo "<script>alert('Terima Kasih...');document.location.href='pengendara/pengendara/index.php?nama=$username'</script>";
}
?>

<body>
	<div class="col-md-12 text-center">

    <!-- start: Content -->
    <form method="post">
      <div class="page-404" style="margin-top: -100px;"> 
        <i class="icon-logout icons" style="font-size: 54pt;color: #f36f5b;"> </i>
        <h2 style="color : #029688;font-size: 22pt">
         Keluar Parkir
       </h2>
       <?php echo $jam_keluar ?>
       <h1 style="color : #f36f5b;font-weight: bold;font-size: 38pt;margin-top: -10px">
         <?php echo $data['no_kendaraan'] ?>
       </h1>

       <label style="color: #029688;font-weight:bold;margin-top: 3px;">Total</label>
       <div class="input-group col-md-3 " style="margin-left: 37% !important;height: 40px;">
        <span class="input-group-addon" id="basic-addon1" style="font-size: 15pt">Rp.</span>
        <input type="number" class="form-control" aria-describedby="basic-addon1" style="font-size: 17pt;height: 40px;" name="total" value="<?= $hasil ?>" readonly>
      </div>
      <label style="color: #029688;font-weight:bold;margin-top: 13px;">Bayar</label>
      <div class="input-group col-md-3 " style="margin-left: 37% !important;height: 40px;">
        <span class="input-group-addon" id="basic-addon1" style="font-size: 15pt">Rp.</span>
        <input type="number" class="form-control" aria-describedby="basic-addon1" style="font-size: 17pt;height: 40px;" name="bayar" required="">
      </div>
      <button type="submit" class="btn btn-outline btn-danger" style="width: 13%;height: 1%; margin-top: 1%" name="btn_hitung">
        <div style="font-size: 14pt; font-weight: bold;">
          <span class="icons icon-calculator"> </span>
          Hitung
        </div>
      </button><br/>
    </form>
    <form method="post">
      <?php if(@$kembali != 0){ ?>
      <label class="animated fadeInDown" style="color: #029688;font-weight:bold;margin-top: 13px;">Kembali</label>
      <div class="input-group col-md-3 animated fadeInDown" style="margin-left: 37% !important;height: 40px;">
        <span class="input-group-addon" id="basic-addon1" style="font-size: 15pt">Rp.</span>
        <input type="number" class="form-control" aria-describedby="basic-addon1" style="font-size: 17pt;height: 40px;" value="<?= @$kembali ?>" name="bayar" readonly>
      </div>
      <button type="submit" class="btn btn-outline btn-danger animated fadeInDown" style="width: 13%;height: 1%; margin-top: 1%" name="btn_back">
        <div style="font-size: 14pt; font-weight: bold;">
          <span class="icons icon-action-undo"> </span>
          Kembali
        </div>
      </button>
      <?php } ?>
    </div>
  </form>
  <!-- end: content -->
</div>
</script>
</body>
</html>