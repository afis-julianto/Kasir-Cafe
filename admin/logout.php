<?php
	ini_set('session.save_path', 'C:\xampp\tmp');
	session_start();
	session_destroy();
	echo "<script>alert('Anda Telah Keluar, Silahkan Login Kembali'); window.location = 'index.php'</script>";
?>
