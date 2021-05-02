<?php
include("includes/header.php"); //Header 
//Get username parameter from url
if(isset($_GET['username'])) {
    $username = $_GET['username'];
}
else {
    $username = $userLoggedIn; //If no username set in url, use user logged in instead
}
?>

<div class="main_column column-posts" id="main_column">

	<h4>Friend Requests</h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no friend requests at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$user_from_obj = new User($con, $user_from);

			echo "<a href='$user_from'><b>" . $user_from_obj->getFirstAndLastName() . "</b></a>" . " sent you a friend request!";

			$user_from_friend_array = $user_from_obj->getFriendArray();

			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "You are now friends!";
				header("Location: requests.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Request ignored!";
				header("Location: requests.php");
			}

			?>
			<form action="requests.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
				<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
			</form>
			<?php


		}

	}

	?>


</div>

<div style="margin-top: 20px;" class="main_column column" id="main_column">
		<h4>	 Your  Friends:</h4>
	<?php
	$user_obj = new User($con, $username);
	 
	foreach($user_obj->getFriendsList() as $friend) {
	 
	    $friend_obj = new User($con, $friend);
	 
	    echo "<a href='$friend'>
	            <img class='profilePicSmall' src='" . $friend_obj->getProfilePic() ."'>"
	            . $friend_obj->getFirstAndLastName() . 
	        "</a>
	        <br>";
	}
	?>
 
</div>