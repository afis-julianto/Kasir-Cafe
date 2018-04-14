<?php
define("BASEPATH", dirname(__FILE__));

include "../../config/connection.php";

  $karyawan = isset($_POST['id_karyawan'])?$_POST['id_karyawan']:"";
 

	try {
		
		$sql = "SELECT * FROM tbl_karyawan
				WHERE id_karyawan='$karyawan'";
				
		$stmt = $conn->prepare($sql); 
		$stmt->execute();

		$hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		$h1=str_replace("[","",json_encode($hasil));
		echo str_replace("]","",$h1);
			
	} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>