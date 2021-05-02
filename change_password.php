<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Change password</title>
	<meta name="description" content="Register now to the new socialnetwork website. Vortexfeed ! Create new account ! Log In !">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	
	
	</style>
	
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
</head>
<body>

<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];		
	}
	$show_array="";

	if(isset($_POST['change_password'])){
		$password = $_POST['log_password_new'];

	if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Your password must be betwen 8 and 30 characters<br>");
	}


	if(empty($error_array)) {
		$show_array = "<h2>Password has been updated. <br> Get back to Login Page</h2><br>";
		$password = md5($password); //Encrypt password before sending to database
		$update_password_query = mysqli_query($con, "UPDATE users SET password='$password' WHERE id='$id'");


	}

}

?>

	
	<div class="wrapper">
		
		
		<div class="login_box">
			<div class="login_header">
				<span class="login_text"><h1>New Password</h1>
				</span>
				<h4>Password must be at lest 8 characters long</h4>
			</div>
			
			<br>
			<div id="first" class="change password">

			
			

			<form action=<?php echo '"' . 'change_password.php?id=' . $id . '"' ?> method="POST">
					<?php if ($show_array == "") {
						echo '<input type="text" name="log_password_new" placeholder="New Password" required>
					
					<input type="submit" name="change_password" value="Change Password">
					<br>';

					} ?>

					<?php if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
					else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; 
					if($show_array != ""){
						echo $show_array;

					}

						?>
					
						<br>
						<a href="register.php" class="signup">Back to Register</a>
					

				</form>
				

		</div>

	</div>



</body>
</html>