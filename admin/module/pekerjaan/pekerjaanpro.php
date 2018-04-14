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

// Hapus Pekerjaan
if ($act=='delete'){
  try {
	  $id = $_GET['id'];
	  $sql="DELETE FROM tbl_pekerjaan WHERE id_pekerjaan='$id'";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute();  
	  header('location:../../adminpanel.php?page=pekerjaan');
  } 
  catch(PDOException $e)
  {
	  echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
}

// Input Pekerjaan
elseif ($act=='save'){

  
  $id		 	= $_POST['id'];
  $pekerjaan 	= $_POST['pekerjaan'];
  
	try {
		$sql = "INSERT INTO tbl_pekerjaan	(id_pekerjaan,
											 nama_pekerjaan) 
						  VALUES			('$id',
											 '$pekerjaan')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} 
	
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;	
	header('location:../../adminpanel.php?page=pekerjaan');
}

// Update Pekerjaan
elseif ($act=='edit'){
  
  $id 			= $_POST['id'];
  $pekerjaan 	= $_POST['pekerjaan'];
  
	try{
		$sql = "UPDATE tbl_pekerjaan  	SET 		nama_pekerjaan 	= '$pekerjaan'
										WHERE	   	id_pekerjaan  	= '$id'";	

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	header('location:../../adminpanel.php?page=pekerjaan');

}
}
?>
