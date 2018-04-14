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

// Hapus User
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_menu WHERE id_menu='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  $gambar = filcar($_GET['img']);
	  unlink("../../uploads/img_menu/$gambar");  
	  header('location:../../adminpanel.php?page=menu');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input User
elseif ($act=='save'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 $tipe_file      = $_FILES['fupload']['type'];
 $nama_file      = $_FILES['fupload']['name'];
 $acak           = rand(1,99);
 $nama_file_unik = $acak.$nama_file;
  
  $id		 		= $_POST['id'];
  $nama		 		= $_POST['nama'];
  $harga		 	= $_POST['harga'];
  $kategori		 	= $_POST['kategori'];
  $diskon			= $_POST['diskon'];

 
  
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=menu)</script>";
    }
    else{
	
    UploadMenu($nama_file_unik);
	try {
		$sql = "INSERT INTO tbl_menu	(id_menu,
										 nama_menu,
										 harga_menu,
										 id_kategori,
										 foto,
										 diskon_menu) 
						  VALUES		('$id',
										 '$nama',
										 '$harga',
										 '$kategori',
										 '$nama_file_unik',
										 '$diskon')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=menu');
	}
  } 
  else {
	try {
		$sql = "INSERT INTO tbl_menu	(id_menu,
										 nama_menu,
										 harga_menu,
										 id_kategori,
										 diskon_menu) 
						  VALUES		('$id',
										 '$nama',
										 '$harga',
										 '$kategori',
										 '$diskon')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=menu');
  }	
}

// Update Menu
elseif ($act=='edit'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 $tipe_file      = $_FILES['fupload']['type'];
 $nama_file      = $_FILES['fupload']['name'];
 $acak           = rand(1,99);
 $nama_file_unik = $acak.$nama_file;
  
  $id		 		= $_POST['id'];
  $nama		 		= $_POST['nama'];
  $harga		 	= $_POST['harga'];
  $kategori		 	= $_POST['kategori'];
  $fotol 			= $_POST['fotol'];
  $diskon			= $_POST['diskon'];
 
  
  if(!empty($lokasi_file)){
	
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=menu)</script>";
    }
    else{
	unlink("../../uploads/img_user/$fotol");  
    UploadMenu($nama_file_unik);
	try{
		$sql = "UPDATE tbl_menu SET 		nama_menu 	 = '$nama',
											harga_menu	 = '$harga',
											id_kategori  = '$kategori',
											foto	   	 = '$nama_file_unik',
											diskon_menu	 = '$diskon'
								 WHERE	   	id_menu      = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=menu');
	}
  } 
  else {
	try{
			$sql = "UPDATE tbl_menu SET 	nama_menu 	 = '$nama',
											harga_menu	 = '$harga',
											id_kategori  = '$kategori',
											diskon_menu	 = '$diskon'
									 WHERE	id_menu      = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=menu');  
  }	 
}
}
?>
