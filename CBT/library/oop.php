<?php 
	class oop{

		function simpan($con, $table, $isi, $form)
		{
			
			$sql = "INSERT INTO $table SET $isi";
			$query = mysqli_query($con, $sql);		
			if($query) {
			echo "<script>alert('success');document.location.href='$form'</script>";
			}else{
			echo "<script>alert('Failed');document.location.href='$form'</script>";
			}
		}
		function tampil($con, $table)
		{
			$sql = "SELECT * FROM $table";
			$query = mysqli_query($con, $sql);
			$data;
			while($data = mysqli_fetch_array($query))
				$isi[] = $data;
			return $isi;
			
		}
		function tampil1($con, $table){
			$sql = "SELECT * FROM $table WHERE jenis='Motor'";
			$query = mysqli_query($con, $sql);
			$data;
			while($data = mysqli_fetch_array($query))
				$isi[] = $data;
			return $isi;
		}
		function hapus($con, $table, $where, $form)
		{
			$sql = "DELETE FROM $table WHERE $where";
			$query = mysqli_query($con, $sql);
			if ($query) {
				echo "<script>alert('Success');document.location.href='$form'</script>";
			}else{
				echo "<script>alert('Failed');document.location.href='$form'</script>";
			}
		}
		function edit($con, $table, $where)
		{
			$sql = "SELECT * FROM $table WHERE $where";
			$query = mysqli_query($con, $sql);
			$isi = mysqli_fetch_array($query);
			return $isi;
		}
		function ubah($con, $table, $isi, $where, $form){
			$sql = "UPDATE $table SET $isi WHERE $where";
			$query = mysqli_query($con, $sql);
			if($query) {
				echo "<script>alert('Success');document.location.href='$form'</script>";
			}else{
				echo "<script>alert('Failed');document.location.href='$form'</script>";
			}
		}
	}
 ?>