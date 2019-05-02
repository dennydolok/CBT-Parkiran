<!DOCTYPE html>
<html lang="en">
<?php 
  include 'config/controllers.php';
  include 'library/oop.php';
  $perintah = new oop();
  $form="penjaga.php";
  $kd_penjaga = "PP" . rand(001,200);
  @$table = "tbl_penjaga";
  @$encode = $_POST['password']; 
  @$isi= "kd_penjaga = '$kd_penjaga', nama_penjaga='$_POST[nama_penjaga]', username='$_POST[username]', password = '$encode', shift = '$_POST[shift]'";
  if (isset($_POST['simpan'])) {
  	if ($_POST['nama_penjaga'] == "" || $_POST['username'] == "" || $_POST['password'] == "") {
  		echo "<script>alert('isi Harus Lengkap');document.location.href='$form'</script>";
  	}else{
  		$perintah->simpan($con, $table, $isi, $form);
  	}
  }
  if (isset($_GET['hapus'])) {
  		@$where = "kd_penjaga = '$_GET[id]'";
		  $perintah->hapus($con, $table, $where, $form);
	}
  if (isset($_GET['edit'])) {
  $sql = "SELECT * FROM tbl_penjaga WHERE kd_penjaga ='$_GET[id]'";
  $query = mysqli_query($con,$sql);
  $redit = mysqli_fetch_array($query);
  }
  if (isset($_POST['update'])) {
    $pass = base64_encode($_POST['password']);
    $sql = "UPDATE tbl_penjaga SET nama_penjaga = '$_POST[nama_penjaga]', username = '$_POST[username]', password = '$pass', shift = '$_POST[shift]' WHERE kd_penjaga = '$_GET[id]'";
    $query = mysqli_query($con,$sql);
    echo "<script>alert('Success!');document.location.href='?form'</script>";
  }
 ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Parkir</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/isitables/isiTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
</head>

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
          <a class="nav-link" href="Penjaga.php">
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
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        </li>
        <li class="breadcrumb-item active">Penjaga</li>
      </ol>
      <!-- Example isiTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tabel Data Penjaga</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="example" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode Penjaga</th>
                  <th>Nama Penjaga</th>
                  <th>Username</th>
                  <th>Password</th>
                  
                  <th>Shift</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $tampil = $perintah->tampil($con, $table);
                $no = 0;
                
                    foreach ($tampil as $field)
                    {
                      $no++;
               ?>
               <tr>
                <td><?php echo @$field['kd_penjaga']; ?></td>
                <td><?php echo @$field['nama_penjaga']; ?></td>
                <td><?php echo @$field['username']; ?></td>
                <td><?php echo @$field['password']; ?></td>
                <td><?php if (@$field['shift'] == "1") {
                  echo "Pagi";
                }else if (@$field['shift']=="2") {
                  echo "Siang";
                }else{
                  echo "Malam";
                }?></td>
                <td><a onclick="return confirm('Yakin Mau Dihapus???')" href="?menu=form&hapus&id=<?php echo @$field[kd_penjaga]?>">Hapus</a>
 	 		        	<a href="?menu=form&edit&id=<?php echo @$field[kd_penjaga]?>">edit</a></td>
               </tr>
               <?php } ?> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card mb-3">
          <div class="card-header">
            Input Data Penjaga
          </div>
          <div class="card-body" style="padding:15px;">
            <form method="post" action="" class="form-inline">          
            <div class="form-group" style="padding:15px;">
              <label class="sr-only">Nama Penjaga</label>
              <input type="text" class="form-control" value="<?php  echo @$redit['1'] ?>" placeholder="Nama Penjaga" name="nama_penjaga">
            </div>
            <div class="form-group" style="padding:15px;">
              <label class="sr-only">Password</label>
              <input type="text" class="form-control" value="<?php echo @$redit['username'] ?>" placeholder="Username" name="username">
            </div>
            <div class="form-group" style="padding:15px;">
              <label class="sr-only">Password</label>
              <input type="password" class="form-control" value="<?php echo base64_decode(@$redit['password']) ?>"  placeholder="Password" name="password">
            </div>
            <div class="form-group">
             <select class="form-control" name="shift" id="shift">
        <option value="" readonly>Pilih Shift</option>
				<option value="<?php echo @$redit['shift'] ?>"><?php echo @$redit['shift'] ?></option>
				<option value="1">Pagi</option>
				<option value="2">Siang</option>
				<option value="3">Malam</option>
			</select>
			</div>    
			<div style="padding: 35px;">
			<?php if(@$_GET['id']==""){ ?>
              <input class="btn btn-primary" type="submit" name="simpan" value="Save">
              <?php }else{ ?>
              <input class="btn btn-primary" type="submit" name="update" value="Update">
              <?php } ?>
			</div>
            </form>
            </div>
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
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-isitables.min.js"></script>
  </div>
</body>
</html>