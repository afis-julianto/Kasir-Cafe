<?php
ini_set('session.save_path', 'C:\xampp\tmp');
session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}

else{

define("BASEPATH", dirname(__FILE__));
include "../../config/connection.php";
include "../../config/fungsi_seo.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";

$act= isset($_GET['act'])? filcar($_GET['act']):"";

// Hapus Penjualan
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_gaji WHERE id_gaji='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=gaji');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}


// Input Gaji
elseif ($act=='save'){

  $id		 			= $_POST['id'];
  $karyawan				= $_POST['nama_karyawan'];
  $tanggal				= $_POST['tanggal'];
  $jam_lembur	 		= $_POST['jam_lembur'];
  $biaya_lembur	 		= $_POST['biaya_lembur'];
  $total_biaya_lembur	= $_POST['total_lembur'];
  $gaji_pokok	 		= $_POST['gaji_pokok'];
  $pinjam_uang			= $_POST['hutang'];
  $total_gaji		 	= $_POST['total_gaji'];
 
	try {
		$sql = "INSERT 	INTO tbl_gaji		(id_gaji,
											 id_karyawan,
											 tgl_gaji,
											 jam_lembur,
											 biaya_lembur,
											 total_biaya_lembur,
											 gaji_pokok,
											 pinjam_uang,
											 total_gaji) 
						VALUES				('$id',
											 '$karyawan',
											 '$tanggal',
											 '$jam_lembur',
											 '$biaya_lembur',
											 '$total_biaya_lembur',
											 '$gaji_pokok',
											 '$pinjam_uang',
											 '$total_gaji')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=gaji');
}


// Update Penjualan
elseif ($act=='edit'){
  
  $id = $_POST['id'];

	try{
			$sql = "UPDATE tbl_users SET 		nama_lengkap = '$nama',
												username	 = '$username',
												password     = '$password',
												level  		 = '$level',
												no_telp      = '$no_telp',
												foto	   	 = '$nama_file_unik',
												blokir		 = '$blokir'
									 WHERE	   	id_user      = '$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=user');
}

}
?>
