<?php
	$conn=mysqli_connect("localhost", "root", "", "qcresorts_db");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>