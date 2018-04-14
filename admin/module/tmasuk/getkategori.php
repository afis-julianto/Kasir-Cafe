<?php

define("BASEPATH", dirname(__FILE__));

include "../../config/connection.php";

$kategori = isset($_POST['id_kategori'])?$_POST['id_kategori']:"";
 

	try {
		$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'   ORDER BY nama_menu ASC";
					$stmt = $conn->prepare($sql); 
					$stmt->execute();
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
			 
			foreach($stmt->fetchAll() as $k=>$r){
				echo "<option value=\"$r[id_menu]\" >$r[nama_menu]</option>";
			}
	} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>