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
	$str="";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$data_query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
		$row = mysqli_fetch_array($data_query);
		$token = $row['token'];
		$try = $row['try'];	
			
			
	}
	else {
		$id=0;
	}

	if(isset($_POST['verify_token_button'])){
		$id = $_GET['id'];
		$try--;

		$update_try_query = mysqli_query($con, "UPDATE users SET try='$try' WHERE id='$id'");
		$token_entered = $_POST['log_token'];
		if($token_entered == $token) {
			header("Location:change_password.php?id=$id");
		}
		else {
			if($try != 1) {
			$str = "Wrong Code <br>
					Only " . $try . " tries left!
			";
			}
			else {
				$str = "Wrong Code <br>
					Only " . $try . " try left!
			";
			}
			
		}
			
	}

	if(isset($_POST['generate_token_button'])){
		$id = $_GET['id'];
		$data_query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
		$row = mysqli_fetch_array($data_query);
		$email = $row['email'];


		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$random_token = mt_rand(100000, 999999);
		$query = mysqli_query($con, "UPDATE users SET token='$random_token' , try='3' WHERE email='$email'");


		


		$to      = $email;
		$subject = 'Change Password';
		$message = '
			

			<h2> Your Code is : <h2>
			<br>
			<h1> '. $random_token . '</h1>

			<br>
			<br>
			<h2>You have 3 tries to enter the correct code! After that you will have to generate another code !</h2>
		';
		$headers = 'From: support@vortexfeed.com' . "\r\n" .
		    'Reply-To: support@vortexfeed.com' . "\r\n" .
		    'MIME-Version: 1.0' . "\r\n".
		    'Content-type: text/html; charset=iso-8859-1' . "\r\n".
		    'X-Mailer: PHP/' . phpversion();

		
		    mail($to, $subject, $message, $headers);

		header("Location: change_password_verify.php?id=$id");
			
	}

 ?>
	
	
	<div class="wrapper">
		
		
		<div class="login_box">
			<div class="login_header">
				<span class="login_text"><h1>Change Password</h1>
				</span>
			</div>
			
			<br>
			<div id="first" class="change password">



			
			

			<form action=<?php echo '"' . 'change_password_verify.php?id=' . $id . '"' ?> method="POST">
				
				<?php if($try > 0 ) { echo '	<h5>An email has been sent to the specified email address with a 6-digit number. Enter it below :</h5><input type="text" name="log_token" placeholder="6-digit code" required>
					
					<input type="submit" name="verify_token_button" value="Verify Code">
					<h4>' . $str . '</h4>';
				} 

				else if($try == 0 && $id!=0 ) { echo '<h4> Too many tries. Generate another code </h4> <br>  <input type="submit" name="generate_token_button" value="Generate Code">';

					}
					else if($try == 0 && $id==0 ) {
						echo'<h4> No account associated with this email address ! </h4><br>';

					}



					?>
					
					<br>
					<a href="register.php" class="signup">Back to Register</a>

				</form>
				

		</div>

	</div>



</body>
</html>