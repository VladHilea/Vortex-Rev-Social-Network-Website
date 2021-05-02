<?php 
include("includes/header.php");

if(isset($_GET['username'])) {
	$username = $_GET['username'];
	 $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
  $user = mysqli_fetch_array($user_details_query);
}
else {
	$username = "";
}

if(isset($_POST['post'])){

	$uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/images/posts/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], $username, $imageName);
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}
	header("location: index.php");

}


 ?>

 <div class="user_details column-posts-user ">
		<a href="<?php echo $userLoggedIn; ?>">  <img class="rounded-circle" src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>

	</div>
	

	<div class="main_column">
		<div class="column-posts-add">
			<a class="img-mobile" href="<?php echo $userLoggedIn; ?>">  <img class="rounded-circle" src="<?php echo $user['profile_pic']; ?>"> </a>
			<div class="user_details_left_right_mobile">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>
			

		<form class="post_form" action=<?php echo '"' . 'post_on_profile.php?username=' . $username . '"' ?> method="POST" enctype="multipart/form-data">
			<h2>Post to <a href="<?php echo $username; ?>"><?php 
			if($username != $userLoggedIn){
			echo $user['first_name'] . "'s" ;
			}
			else {
				echo 'your';
			}

			 ?></a> profile </h2>
			<h4>Add Photo</h4>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			

		</form>
		</div>
		


	</div>

	<script>

	$(document).ready(function() {

	document.getElementById('toggle-button').addEventListener('click', function () {
    toggle(document.querySelectorAll('.target'));
});
function toggle (elements, specifiedDisplay) {
  var element, index;

  elements = elements.length ? elements : [elements];
  for (index = 0; index < elements.length; index++) {
    element = elements[index];

    if (isElementHidden(element)) {
      element.style.display = '';

      // If the element is still hidden after removing the inline display
      if (isElementHidden(element)) {
        element.style.display = specifiedDisplay || 'block';
      }
    } else {
      element.style.display = 'none';
    }
  }
  function isElementHidden (element) {
    return window.getComputedStyle(element, null).getPropertyValue('display') === 'none';
  }
}
});

