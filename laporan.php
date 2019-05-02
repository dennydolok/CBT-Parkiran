<!DOCTYPE html>
<html lang="en">
<?php 
  $isi['1'] ="";
  $isi['2'] = "";
  include 'config/koneksi.php';
  include 'library/oop.php';
  $perintah = new oop();
  $kd_admins = "AD" . rand(001,200);
  $form="admin.php";
  @$table = "tbl_admin";

  @$isi= "kd_admin = '$kd_admins', nama_admin='$_POST[nama_admin]', username='$_POST[username]', password = '$_POST[password]', shift = '$_POST[shift]'";
  if (isset($_POST['simpan'])) {
  	if ($_POST['nama_admin'] == "" || $_POST['username'] == "" || $_POST['password'] == "" || $_POST['shift']=="") {
  		echo "<script>alert('isi Harus Lengkap');document.location.href='$form'</script>";
  	}else{
  		$perintah->simpan($con, $table, $isi, $form);
  	}
  }
  if (isset($_GET['hapus'])) {
  		@$where = "kd_admin = '$_GET[id]'";
		  $perintah->hapus($con, $table, $where, $form);
	}
  if (isset($_GET['edit'])) {
  $sql = "SELECT * FROM tbl_admin WHERE kd_admin ='$_GET[id]'";
  $query = mysqli_query($con,$sql);
  $redit = mysqli_fetch_array($query);
  $sel = "selected";
  if($redit['shift']=="1"){
    $kerja = "Pagi";
  }else if($redit['shift']=="2"){
    $kerja = "Siang";
   }else{
     $kerja = "Malam";
   }
  }
  if (isset($_POST['update'])) {
    $deco = base64_encode($_POST['password']);
    $sql = "UPDATE tbl_admin SET nama_admin = '$_POST[nama_admin]', username = '$_POST[username]', password = '$deco', shift = '$_POST[shift]' WHERE kd_admin = '$_GET[id]'";
    $query = mysqli_query($con,$sql);
      echo "<script>alert('success');document.location.href='?form'</script>";
    }
 ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/isitables/isiTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/laporTables.bootstrap4.min.css">
</head>
<script language="javascript">
  function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Dashboard Admin</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" isi-toggle="collapse" isi-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" isi-toggle="tooltip" isi-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php" onclick="return confirm('Logout???')">
            <i class="fa fa-fw fa-lock"></i>
            <span class="nav-link-text">Logout</span>
          </a>
        </li>
        <li class="nav-item" isi-toggle="tooltip" isi-placement="right" title="Dashboard">
          <a class="nav-link" href="penjaga.php">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Penjaga</span>
          </a>
        </li>
        <li class="nav-item" isi-toggle="tooltip" isi-placement="right" title="Dashboard">
          <a class="nav-link" href="admin.php">
            <i class="fa fa-fw fa-lock"></i>
            <span class="nav-link-text">Admin</span>
          </a>
        </li>
        <li class="nav-item" isi-toggle="tooltip" isi-placement="right" title="Dashboard">
          <a class="nav-link" href="laporan.php">
            <i class="fa fa-fw fa-lock"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
        </li>
          
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid" style="height: 100%;">
    <div><input type="button" onClick="PrintDiv();" class="btn btn-info" value="Print"></div>
    <div class="table-responsive">
    <div id="divToPrint">
            <table class="table table-bordered" id="example" cellspacing="0">
            <form method="post">
            <center><h2>Laporan Parkiran</h2></center>
                      
                <tr>
                    <td>Kode Parkir</td>
                    <td>Nomor Kendaraan</td>
                    <td>Jenis Kendaraan</td>
                    <td>Jam Masuk</td>
                    <td>Jam Keluar</td>
                    <td>Nama Penjaga</td>
                </tr>
                <?php
                    $sql = "SELECT * FROM laporan";
                    $query = mysqli_query($con, $sql);
                    while ($lapor = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo @$lapor['0'] ?></td>
                    <td><?php echo @$lapor['1'] ?></td>
                    <td><?php echo @$lapor['2'] ?></td>
                    <td><?php echo @$lapor['3'] ?></td>
                    <td><?php echo @$lapor['4'] ?></td>
                    <td><?php echo @$lapor['5'] ?></td>
                </tr>
                    <?php } ?>
            </form>
            </table>
    </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" isi-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are You sure want to logout</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" isi-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').laporTable();
    } );
    </script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
<script src="js/jquery.laporTables.min.js"></script>
<script src="js/laporTables.bootstrap4.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-isitables.min.js"></script>
  </div>
</body>

</html>
