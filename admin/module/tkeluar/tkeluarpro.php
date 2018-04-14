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

// Hapus Pembelian
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE tbl_pembelian.*, tbl_detail_pembelian.* 
			FROM tbl_pembelian JOIN tbl_detail_pembelian ON tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian 
			WHERE tbl_pembelian.id_pembelian='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=tkeluar');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Hapus Detail Pembelian
elseif ($act=='hapus'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_detail_pembelian WHERE id_detail_pembelian='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=tkeluar&pp=add');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Pembelian
elseif ($act=='save'){

  $id		 		= $_POST['id'];
  $tanggal			= $_POST['tanggal'];
  $total		 	= $_POST['total'];
  //$user				= $_POST($_SESSION['id_user']);

	try {
		$sql = "INSERT 	INTO tbl_pembelian			(id_pembelian,
													 tgl_pembelian,
													 total_transaksi,
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
	header('location:../../adminpanel.php?page=tkeluar');
}

// Input Detail Pembelian
elseif ($act=='simpan'){

  $id		 		= $_POST['id'];
  $nama		 		= $_POST['nama'];
  $harga			= $_POST['harga'];
  $jumlah		 	= $_POST['jumlah'];
  $total	 		= $_POST['total'];

	try {
		$sql = "INSERT 	INTO tbl_detail_pembelian	(id_pembelian,
													 nama_barang,
													 harga, 
													 jumlah,
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
	header('location:../../adminpanel.php?page=tkeluar&pp=add');
}


// Update Pembelian
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

// Update Detail Pembelian
elseif ($act=='rubah'){
  
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
