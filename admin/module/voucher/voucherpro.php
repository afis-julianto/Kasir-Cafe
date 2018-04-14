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

// Hapus Voucher
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_voucher WHERE id_voucher='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();  
	  header('location:../../adminpanel.php?page=vo');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Voucher
elseif ($act=='save'){
	
  $id		 	= $_POST['id'];
  $nama 		= $_POST['nama'];
  $total 		= $_POST['total'];
  $masa_aktif 	= $_POST['masa_aktif'];
  $kode 		= $_POST['kode'];
  
	try {
		$sql = "INSERT INTO tbl_voucher		(id_voucher,
											 nama_voucher, 
											 total, 
											 masa_aktif, 
											 kode_voucher) 
						  VALUES			('$id',
											 '$nama',
											 '$total',
											 '$masa_aktif',
											 '$kode')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=vo');
}

// Update agenda
elseif ($act=='edit'){
  
  $id		 	= $_POST['id'];
  $nama 		= $_POST['nama'];
  $total 		= $_POST['total'];
  $masa_aktif 	= $_POST['masa_aktif'];
  $kode 		= $_POST['kode'];
  
	try{
		$sql = "UPDATE tbl_voucher	 SET 		nama_voucher 	= '$nama',
												total			= '$total',
												masa_aktif		= '$masa_aktif',
												kode_voucher	= '$kode'
									 WHERE	   	id_voucher  	= '$id'";	

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=vo');

}
}
?>
