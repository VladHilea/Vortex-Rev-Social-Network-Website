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

if(isset($_POST['change_pass_button'])) {
		$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
		$random_token = mt_rand(100000, 999999);
		$query = mysqli_query($con, "UPDATE users SET token='$random_token' , try='3' WHERE email='$email'");


		$data_query = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
		$row = mysqli_fetch_array($data_query); 
			$id = $row['id'];


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

			
			

			<form action="forgot_password.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					
					<input type="submit" name="change_pass_button" value="Change Password">
					
					<br>
					<a href="register.php" class="signup">Back to Register!</a>

					

				</form>
				

		</div>

	</div>



</body>
</html>