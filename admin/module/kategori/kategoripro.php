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

// Hapus Kategori
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_kategori WHERE id_kategori='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();  
	  header('location:../../adminpanel.php?page=kategori');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Kategori
elseif ($act=='save'){

  
  $id		 	= $_POST['id'];
  $kategori 	= $_POST['kategori'];
  
	try {
		$sql = "INSERT INTO tbl_kategori	(id_kategori,
											 nama_kategori) 
						  VALUES			('$id',
											 '$kategori')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=kategori');
}

// Update Kategori
elseif ($act=='edit'){
  
  $id 			= $_POST['id'];
  $kategori 	= $_POST['kategori'];
  
	try{
		$sql = "UPDATE tbl_kategori  SET 		nama_kategori 	= '$kategori'
									 WHERE	   	id_kategori  	= '$id'";	

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=kategori');


}
}
?>
