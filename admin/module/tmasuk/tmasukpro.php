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
	  $sql="DELETE tbl_detail_penjualan.*, tbl_penjualan.*
			FROM tbl_penjualan JOIN tbl_detail_penjualan ON tbl_penjualan.id_penjualan=tbl_detail_penjualan.id_penjualan
			WHERE tbl_penjualan.id_penjualan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=tmasuk');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Hapus Detail Penjualan
elseif ($act=='hapus'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_detail_penjualan WHERE id_detail_penjualan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  header('location:../../adminpanel.php?page=tmasuk&pp=add');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Penjualan
elseif ($act=='save'){

  $id		 			= $_POST['id'];
  $tanggal				= $_POST['tanggal'];
  $total_transaksi		= $_POST['total'];
  $nama_pelanggan		= $_POST['nama_pelanggan'];
  $no_meja		 		= $_POST['meja'];
  $voucher		 		= $_POST['voucher'];
  $total_bayar	 		= $_POST['total_pembayaran'];
  $uang_bayar	 		= $_POST['bayar'];
  $uang_kembali	 		= $_POST['kembali'];
  $pajak		 		= $_POST['pajak'];
  $pendapatan_bersih 	= $_POST['pendapatan_bersih'];

	try {
		$sql = "INSERT 	INTO tbl_penjualan			(id_penjualan,
													 tgl_penjualan,
													 total_transaksi,
													 id_user,
													 nama_pelanggan,
													 no_meja,
													 voucher,
													 total_bayar,
													 uang_bayar,
													 uang_kembali,
													 pajak,
													 pendapatan_bersih) 
						VALUES						('$id',
													 '$tanggal',
													 '$total_transaksi', 
													 '$_SESSION[id_user]',
													 '$nama_pelanggan',
													 '$no_meja',
													 '$voucher',
													 '$total_bayar',
													 '$uang_bayar',
													 '$uang_kembali',
													 '$pajak',
													 '$pendapatan_bersih')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=tmasuk');
}

// Input Detail Penjualan
elseif ($act=='simpan'){

	$id		 		= $_POST['id'];
	$id_menu		= $_POST['id_menu'];
	$jumlah		 	= $_POST['jumlah'];
	$total	 		= $_POST['total'];
	$diskon	 		= $_POST['diskon'];
	$harga	 		= $_POST['harga'];

	try {
		$sql = "INSERT 	INTO tbl_detail_penjualan	(id_penjualan,
													 id_menu,
													 jumlah, 
													 total,
													 harga,
													 diskon) 
						VALUES						('$id',
													 '$id_menu',
													 '$jumlah',
													 '$total',
													 '$harga',
													 '$diskon')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=tmasuk&pp=add');
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

// Update Detail Penjualan
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
