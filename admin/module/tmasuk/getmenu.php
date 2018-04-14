<?php
define("BASEPATH", dirname(__FILE__));

include "../../config/connection.php";

  $menu = isset($_POST['id_menu'])?$_POST['id_menu']:"";
 

	try {
		
		$sql = "SELECT * FROM tbl_menu JOIN tbl_kategori ON tbl_menu.id_kategori=tbl_kategori.id_kategori
				WHERE tbl_menu.id_menu='$menu'";
				
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