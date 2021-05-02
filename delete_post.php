<?php 


include("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}

if(isset($_POST['cancel'])) {
	header("Location: index.php");
}

if(isset($_POST['delete_post'])) {
	$delete_query = mysqli_query($con, "UPDATE posts SET deleted='yes' WHERE id='$id'");
	header("Location: index.php");
}


?>





<div class="main_column column-posts">
	
	<h4>Delete Post</h4>
	Are you sure you want to delete this post <br><br>
	This will delete your post permanentely and you and your friends won't be able to see it anymore!<br><br>

	<div class="posts_area">
			<?php 
			$post = new Post($con, $userLoggedIn);
			$post->getSinglePostDelete($id);
			?>
			

	</div>
	<br>

	<form action=<?php echo '"' . 'delete_post.php?id=' . $id . '"' ?> method="POST">
		<input type="submit" name="delete_post" id="delete_post" value="Yes! delete it" class="danger settings_submit">
		<input type="submit" name="cancel" id="update_details" value="No way!" class="info settings_submit">
	</form>

</div>