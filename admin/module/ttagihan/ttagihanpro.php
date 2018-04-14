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

// Hapus Tagihan
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE tbl_tagihan.*, tbl_detail_tagihan.* 
			FROM tbl_tagihan JOIN tbl_detail_tagihan ON tbl_tagihan.id_tagihan=tbl_detail_tagihan.id_tagihan 
			WHERE tbl_tagihan.id_tagihan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=ttagihan');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Hapus Detail Tagihan
elseif ($act=='hapus'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_detail_tagihan WHERE id_detail_tagihan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=ttagihan&pp=add');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Tagihan
elseif ($act=='save'){

  $id		 		= $_POST['id'];
  $tanggal			= $_POST['tanggal'];
  $total		 	= $_POST['total'];
  //$user				= $_POST($_SESSION['id_user']);

	try {
		$sql = "INSERT 	INTO tbl_tagihan			(id_tagihan,
													 tgl_tagihan,
													 total_tagihan,
													 id_user) 
						VALUES						('$id',
													 '$tanggal',
													 '$total', 
													 '$_SESSION[id_user]')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=ttagihan');
}

// Input Detail Tagihan
elseif ($act=='simpan'){

  $id		 		= $_POST['id'];
  $nama		 		= $_POST['nama'];
  $harga			= $_POST['harga'];
  $jumlah		 	= $_POST['jumlah'];
  $total	 		= $_POST['total'];

	try {
		$sql = "INSERT 	INTO tbl_detail_tagihan		(id_tagihan,
													 nama_tagihan,
													 harga_tagihan, 
													 jumlah_tagihan,
													 total) 
						VALUES						('$id',
													 '$nama',
													 '$harga', 
													 '$jumlah',
													 '$total')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=ttagihan&pp=add');
}
}
?>
