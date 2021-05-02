<?php 

require 'config/config.php';
	
	if(isset($_GET['id'])){
		$id_verify = $_GET['id'];

	
			$query = mysqli_query($con, "UPDATE users SET user_verified='yes' WHERE id='$id_verify'");
			
	}
	
	header("Location: register.php");

 ?>