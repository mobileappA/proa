<?php
	session_start();
	
	unset($_SESSION['cid']);
	unset($_SESSION['cfullname']);
	
	echo "<script>";
			echo "window.location='index.php'; ";
			echo "</script>";
 
?>