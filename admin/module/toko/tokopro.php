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

// Hapus Toko
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_toko WHERE id_toko='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  $gambar = filcar($_GET['img']);
	  unlink("../../uploads/img_toko/$gambar");  
	  header('location:../../adminpanel.php?page=toko');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Toko
elseif ($act=='save'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 $tipe_file      = $_FILES['fupload']['type'];
 $nama_file      = $_FILES['fupload']['name'];
 $acak           = rand(1,99);
 $nama_file_unik = $acak.$nama_file;
  
  $id		 		= $_POST['id'];
  $nama_toko 		= $_POST['nama'];
  $alamat	 		= $_POST['alamat'];
  $no_telp	 		= $_POST['no_telp'];
  $web	 			= $_POST['web'];
  $fb 				= $_POST['fb'];
  $ig	 			= $_POST['ig'];
 
  
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=toko)</script>";
    }
    else{
	
    UploadToko($nama_file_unik);
	try {
		$sql = "INSERT INTO tbl_toko	(id_toko,
										 nama_toko,
										 alamat, 
										 no_telp,
										 website,
										 fb,
										 ig,
										 foto) 
						  VALUES		('$id',
										 '$nama_toko',
										 '$alamat',
										 '$no_telp',
										 '$web',
										 '$fb',
										 '$ig',
										 '$nama_file_unik')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=toko');
	}
  } 
  else {
	try {
		$sql = "INSERT INTO tbl_toko	(id_toko,
										 nama_toko,
										 alamat, 
										 website, 
										 fb, 
										 ig, 
										 no_telp) 
						  VALUES		('$id',
										 '$nama',
										 '$alamat', 
										 '$web', 
										 '$fb', 
										 '$ig', 
										 '$no_telp')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=toko');
  }	
}

// Update Toko
elseif ($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;
  
  $id		 		= $_POST['id'];
  $nama_toko 		= $_POST['nama'];
  $alamat	 		= $_POST['alamat'];
  $no_telp	 		= $_POST['no_telp'];
  $fotol 			= $_POST['fotol'];
  
  $web	 			= $_POST['web'];
  $fb 				= $_POST['fb'];
  $ig	 			= $_POST['ig'];

  
  if(!empty($lokasi_file)){
	
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../adminpanel.php?page=user)</script>";
    }
    else{
	unlink("../../uploads/img_toko/$fotol");  
    UploadToko($nama_file_unik);
	try{
			$sql = "UPDATE tbl_toko 	SET		nama_toko	= '$nama_toko',
												alamat		= '$alamat',
												no_telp     = '$no_telp',
												website     = '$web',
												fb  	    = '$fb',
												ig 	    	= '$ig',
												foto	   	= '$nama_file_unik'
									 WHERE 	    id_toko     = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=toko');
	}
  } else {
	try{
			$sql = "UPDATE tbl_toko SET 		nama_toko 	= '$nama_toko',
												alamat		= '$alamat',
												website     = '$web',
												fb  	    = '$fb',
												ig 	    	= '$ig',
												no_telp     = '$no_telp'
									 WHERE  	id_toko     = '$id'";
									 
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=toko');  
  }	 
}
}
?>
