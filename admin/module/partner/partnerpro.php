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
	  $sql="DELETE FROM tbl_partner WHERE id_partner='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  $gambar = filcar($_GET['img']);
	  unlink("../../uploads/img_partner/$gambar");  
	  header('location:../../adminpanel.php?page=partner');
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
  
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=partner)</script>";
    }
    else{
	
    UploadPartner($nama_file_unik);
	try {
		$sql = "INSERT INTO tbl_partner	(nama_partner,
										 foto) 
						  VALUES		('$nama',
										 '$nama_file_unik')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=partner');
	}
  } 
  else {
	try {
		$sql = "INSERT INTO tbl_partner	(nama_partner) 
						  VALUES		('$nama')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=partner');
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
  
  if(!empty($lokasi_file)){
	
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=partner)</script>";
    }
    else{
	unlink("../../uploads/img_partner/$fotol");  
    UploadPartner($nama_file_unik);
	try{
		$sql = "UPDATE tbl_partner SET 		nama_partner = '$nama',
											foto	   	 = '$nama_file_unik'
								 WHERE	   	id_partner   = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=partner');
	}
  } 
  else {
	try{
			$sql = "UPDATE tbl_partner 	SET 	nama_partner	= '$nama'
										WHERE	id_partner  	= '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=partner');  
  }	 
}
}
?>
