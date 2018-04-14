<?php
define("BASEPATH", dirname(__FILE__));
if(isset($_POST['login'])){
include "config/connection.php";

$username = $_POST['uname'];
$pass     = md5($_POST['pword']);
$row = 0;

try {
	$sql = "SELECT * FROM tbl_users WHERE username='$username' AND password='$pass' AND blokir='N'";
	$stmt = $conn->prepare($sql); 
	$stmt->execute();
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($stmt->rowCount()>0){
  session_start();
  $data=$stmt->fetch();
  include "timeout.php";
  
  if($data['level']=="admin"){
                
				  $_SESSION['username']     = $data['username'];
				  $_SESSION['namalengkap']  = $data['nama_lengkap'];
				  $_SESSION['foto']  		= $data['foto'];
				  $_SESSION['passuser']     = $data['password'];
				  $_SESSION['leveluser']    = $data['level'];
				  $_SESSION['id_user']    	= $data['id_user'];
				  
				  $_SESSION['login'] = 1;
				  timer();
				  
				  $sid_lama = session_id();
				  session_regenerate_id();
				  $sid_baru = session_id();
				  
				  try {
					$sql = "UPDATE tbl_users SET id_session='$sid_baru' WHERE username='$username'";
					$stmt = $conn->prepare($sql); 
					$stmt->execute();
					header('location:adminpanel.php?page=home');
				  }
				  
				  catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				  }
    }
	
	elseif($data['level']=="karyawan"){
		
				  $_SESSION['username']     = $data['username'];
				  $_SESSION['namalengkap']  = $data['nama_lengkap'];
				  $_SESSION['passuser']     = $data['password'];
				  $_SESSION['leveluser']    = $data['level'];
				  $_SESSION['id_user']    	= $data['id_user'];
				  
				  $_SESSION['login'] = 1;
				  timer();
				  
				  $sid_lama = session_id();
				  session_regenerate_id();
				  $sid_baru = session_id();
				  
				  try {
					$sql = "UPDATE tbl_users SET id_session='$sid_baru' WHERE username='$username'";
					$stmt = $conn->prepare($sql); 
					$stmt->execute();
					header('location:adminpanel.php?page=home');
				  }
				  
				  catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				  }		 
    }  
	
	elseif($data['level']=="website"){
		
				  $_SESSION['username']     = $data['username'];
				  $_SESSION['namalengkap']  = $data['nama_lengkap'];
				  $_SESSION['passuser']     = $data['password'];
				  $_SESSION['leveluser']    = $data['level'];
				  $_SESSION['id_user']    	= $data['id_user'];
				  
				  $_SESSION['login'] = 1;
				  timer();
				  
				  $sid_lama = session_id();
				  session_regenerate_id();
				  $sid_baru = session_id();
				  
				  try {
					$sql = "UPDATE tbl_users SET id_session='$sid_baru' WHERE username='$username'";
					$stmt = $conn->prepare($sql); 
					$stmt->execute();
					header('location:adminpanel.php?page=home');
				  }
				  
				  catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				  }		 
    }  
}

else{
  echo "<script>alert('Username atau password salah'); window.location = 'index.php'</script>";
}

$conn = null;
}
?>
