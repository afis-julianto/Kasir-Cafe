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
	  $sql="DELETE FROM tbl_berita WHERE id_berita='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  $gambar = filcar($_GET['img']);
	  unlink("../../uploads/img_berita/$gambar");  
	  header('location:../../adminpanel.php?page=berita');
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
  
  $judul		= $_POST['judul'];
  $p1			= $_POST['p1'];
  $p2			= $_POST['p2'];
  $p3			= $_POST['p3'];
  $p4			= $_POST['p4'];
  $tgl			= $_POST['tgl'];

 
  
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=berita)</script>";
    }
    else{
	
    UploadBerita($nama_file_unik);
	try {
		$sql = "INSERT INTO tbl_berita	(judul_berita,
										 p1,
										 p2,
										 p3,
										 p4,
										 tgl_berita,
										 foto) 
						  VALUES		('$judul',
										 '$p1',
										 '$p2',
										 '$p3',
										 '$p4',
										 '$tgl',
										 '$nama_file_unik')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=berita');
	}
  } 
  else {
	try {
		$sql = "INSERT INTO tbl_berita	(judul_berita,
										 p1,
										 p2,
										 p3,
										 tgl_berita,
										 p4) 
						  VALUES		('$judul',
										 '$p1',
										 '$p2',
										 '$p3',
										 '$tgl',
										 '$p4')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=berita');
  }	
}

// Update Menu
elseif ($act=='edit'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 $tipe_file      = $_FILES['fupload']['type'];
 $nama_file      = $_FILES['fupload']['name'];
 $acak           = rand(1,99);
 $nama_file_unik = $acak.$nama_file;
  
  $id		 	= $_POST['id'];
  $judul		= $_POST['judul'];
  $p1			= $_POST['p1'];
  $p2			= $_POST['p2'];
  $p3			= $_POST['p3'];
  $p4			= $_POST['p4'];
  $tgl			= $_POST['tgl'];
  
  
  if(!empty($lokasi_file)){
	
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=berita)</script>";
    }
    else{
	unlink("../../uploads/img_berita/$fotol");  
    UploadBerita($nama_file_unik);
	try{
		$sql = "UPDATE tbl_berita	SET 		judul_berita = '$judul',
												p1			 = '$p1',
												p2			 = '$p2',
												p3			 = '$p3',
												p4			 = '$p4',
												tgl_berita	 = '$tgl',
												foto	   	 = '$nama_file_unik'
									WHERE	   	id_berita  	 = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=berita');
	}
  } 
  else {
	try{
			$sql = "UPDATE tbl_berita SET 		judul_berita = '$judul',
												p1			 = '$p1',
												p2			 = '$p2',
												p3			 = '$p3',
												tgl_berita	 = '$tgl',
												p4			 = '$p4'
									 WHERE		id_berita    = '$id'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=berita');  
  }	 
}
}
?>
