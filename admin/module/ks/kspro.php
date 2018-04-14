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

// Hapus Karyawan
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_kata_sambutan WHERE id_ks='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();  
	  header('location:../../adminpanel.php?page=ks');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Karyawan
elseif ($act=='save'){
  
  $p1		 	= $_POST['p1'];
  $p2		 	= $_POST['p2'];
  $p3		 	= $_POST['p3'];
  
	try {
		$sql = "INSERT INTO tbl_kata_sambutan	(p1,
											 p2,
											 p3) 
						  VALUES			('$p1',
											 '$p2',
											 '$p3')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=ks');
}

// Update Karyawan
elseif ($act=='edit'){
 
	$p1		 	= $_POST['p1'];
	$p2		 	= $_POST['p2'];
	$p3		 	= $_POST['p3'];
	$id			= $_POST['id'];
  
	try{
		$sql = "UPDATE tbl_kata_sambutan  SET 		p1 		= '$p1',
												p2 		= '$p2',
												p3		= '$p3'
									 WHERE	   	id_ks  	= '$id'";	

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=ks');


}
}
?>
