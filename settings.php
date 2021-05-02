<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<style type="text/css">
	body {
		font-size: 15px;
	}
</style>

<div class="main_column column">

	<h4>Account Settings</h4>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	<br>
	<a href="upload.php">Upload new profile picture</a> <br><br><br>

	<h4>Modify the values and click 'Update Details'</h4><br>

	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email, title_description, user_description FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$title_description = $row['title_description'];
	$user_description = $row['user_description'];
	
	
	?>

	<h4>Acount Details: </h4>
	<form action="settings.php" method="POST">
		First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
		Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
		Email: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><br>
		
		<?php echo $message; ?>
		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit"><br>
	</form>

	<h4>Account Description: </h4>
	<?php 

	if($title_description){
		$create_description = "";
		}
	else
		$create_description ="Add your description so other people can find more about you !";


	
?>
	<div><p class="add_desc"><?php echo $create_description; ?></p></div>
	<form action="settings.php" method="POST">
		Title Description:  <input type="text" name="title_description" value="<?php echo $title_description; ?>" id="settings_input"><?php echo " "; ?>(max 250 characters)<br> 
		Description:<br><br>  <textarea  type="text" name="user_description" value="<?php echo $user_descritpion; ?>" id="settings_input_textarea"></textarea><br>

		<input type="submit" name="update_description" id="save_details" value="Update Description" class="info settings_submit"><br>
		<?php echo $description_message; ?>
	</form>

	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		Old Password: <input type="password" name="old_password" id="settings_input"><br>
		New Password: <input type="password" name="new_password_1" id="settings_input"><br>
		New Password Again: <input type="password" name="new_password_2" id="settings_input" ><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit"><br>
	</form>

	<h4>Close Account</h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
	</form>

	<?php 
	if ($title_description){

	$old_desc="<br>
	<h4>Old Description (in case you want to copy and paste and only change something small to your description): </h4>
	<h5>Title description: </h5>
	<h4> $title_description </h4>
	<h5>Description: </h5>
	<h4> $user_description</h4>";
	}
	else
		$old_desc = "";
	echo $old_desc;
	?>
</div>