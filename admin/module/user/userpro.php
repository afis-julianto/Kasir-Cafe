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
	  $id = base64_decode($_GET['id']);
	  $sql="DELETE FROM tbl_users WHERE id_user='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();
	  $gambar = filcar($_GET['img']);
	  unlink("../../uploads/img_user/$gambar");  
	  header('location:../../adminpanel.php?page=user');
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
  $username 		= $_POST['username'];
  $password 		= md5($_POST['password']);
  $nama  			= $_POST['nama'];
  $level 			= $_POST['level'];
  $no_telp  		= $_POST['no_telp'];
  $blokir 			= !empty($_POST['blokir'])? "Y":"N";
 
  
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../adminpanel.php?page=user)</script>";
    }
    else{
	
    UploadUser($nama_file_unik);
	try {
		$sql = "INSERT INTO tbl_users	(id_user,
										 username,
										 password, 
										 nama_lengkap,
										 no_telp,
										 level,
										 foto,
										 blokir) 
						  VALUES		('$id',
										 '$username',
										 '$password', 
										 '$nama',
										 '$no_telp',
										 '$level',
										 '$nama_file_unik',
										 '$blokir')";
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
  else {
	try {
		$sql = "INSERT INTO tbl_users	(id_user,
										 username,
										 password, 
										 nama_lengkap,
										 no_telp,
										 level,
										 blokir) 
						  VALUES		('$id',
										 '$username',
										 '$password', 
										 '$nama',
										 '$no_telp',
										 '$level',
										 '$blokir')";
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

// Update agenda
elseif ($act=='edit'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;
  
  $id = $_POST['id'];
  $username = $_POST['username'];
  if(!empty($_POST['password']))
	$password = md5($_POST['password']);
  else
	$password = null;
	
  $nama  = $_POST['nama'];

  $no_telp  = $_POST['no_telp'];
  $fotol = $_POST['fotol'];
  
  $level 			= $_POST['level'];
  $blokir 			= !empty($_POST['blokir'])? "Y":"N";
  
  if(!empty($lokasi_file)){
	
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../adminpanel.php?page=user)</script>";
    }
    else{
	unlink("../../uploads/img_user/$fotol");  
    UploadUser($nama_file_unik);
	try{
		if(!empty($password)) {
			$sql = "UPDATE tbl_users SET 		nama_lengkap = '$nama',
												username	 = '$username',
												password     = '$password',
												level  		 = '$level',
												no_telp      = '$no_telp',
												foto	   	 = '$nama_file_unik',
												blokir		 = '$blokir'
									 WHERE	   	id_user      = '$id'";
		}
		else {
			$sql = "UPDATE tbl_users SET		nama_lengkap = '$nama',
												username	 = '$username',
												level 		 = '$level',
												no_telp      = '$no_telp',
												foto	   	 = '$nama_file_unik',
												blokir		 = '$blokir'
									 WHERE 	    id_user      = '$id'";
		}
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
  } else {
	try{
		if(!empty($password)) {
			$sql = "UPDATE tbl_users SET 		nama_lengkap = '$nama',
												username	 = '$username',
												password     = '$password',
												level  		 = '$level',
												no_telp      = '$no_telp',
												blokir		 = '$blokir'
									 WHERE	   	id_user       = '$id'";
		}
		else {
			$sql = "UPDATE tbl_users SET 		nama_lengkap = '$nama',
												username	 = '$username',
												level  		 = '$level',
												no_telp      = '$no_telp',
												blokir		 = '$blokir'
									 WHERE  	id_user      = '$id'";
		}
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
}
?>
