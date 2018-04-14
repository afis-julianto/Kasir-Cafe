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

// Hapus Karyawan
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_karyawan WHERE id_karyawan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();  
	  header('location:../../adminpanel.php?page=karyawan');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Karyawan
elseif ($act=='save'){
  
  $id		 	= $_POST['id'];
  $nama		 	= $_POST['nama'];
  $jk		 	= $_POST['jk'];
  $alamat	 	= $_POST['alamat'];
  $no_hp	 	= $_POST['no_hp'];
  $pekerjaan	= $_POST['pekerjaan'];
  $gaji			= $_POST['gaji'];
  
	try {
		$sql = "INSERT INTO tbl_karyawan	(id_karyawan,
											 nama_karyawan,
											 jk,
											 alamat,
											 no_hp,
											 gaji_pokok,
											 id_pekerjaan) 
						  VALUES			('$id',
											 '$nama',
											 '$jk',
											 '$alamat',
											 '$no_hp',
											 '$gaji',
											 '$pekerjaan')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=karyawan');
}

// Update Karyawan
elseif ($act=='edit'){
  
  $id		 	= $_POST['id'];
  $nama		 	= $_POST['nama'];
  $jk		 	= $_POST['jk'];
  $alamat	 	= $_POST['alamat'];
  $no_hp	 	= $_POST['no_hp'];
  $pekerjaan	= $_POST['pekerjaan'];  
  $gaji			= $_POST['gaji'];
  
	try{
		$sql = "UPDATE tbl_karyawan  SET 		nama_karyawan 	= '$nama',
												jk			 	= '$jk',
												alamat		 	= '$alamat',
												no_hp		 	= '$no_hp',
												gaji_pokok	 	= '$gaji',
												id_pekerjaan	= '$pekerjaan'
									 WHERE	   	id_karyawan  	= '$id'";	

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=karyawan');


}
}
?>
