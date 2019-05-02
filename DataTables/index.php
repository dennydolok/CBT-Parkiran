<!DOCTYPE html>
<html>
<head>
	<title>DataTables</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
</head>
<body>

<center>
<table id="example" class="table table-striped table-bordered" border="1" cellspacing="0" width="100%">
	<thead>
	<tr>
		<td><b>Nama</b></td>
		<td><b>Nis</b></td>
		<td><b>Rayon</b></td>
		<td><b>Rombel</b></td>
		<td><b>Alamat</b></td>
	</tr>
	</thead>

	<tbody>
	<tr>
		<td>Sechan</td>
		<td>11605637</td>
		<td>Ciawi-5</td>
		<td>RPL XI-2</td>
		<td>Kp.Pasir Kalong</td>
	</tr>
	</tbody>
</table>
</center>

<script src="js/jquery-1.12.4.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$('#example').DataTable();
	});
</script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
</body>
</html>