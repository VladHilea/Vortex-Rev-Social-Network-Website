<?php 
include ("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}

?>


	<div class="main_column column-posts" id="main_column">
		
		<div class="posts_area">

			<?php 
			$post = new Post($con, $userLoggedIn);
			$post->getSinglePost($id);
			?>
			
		</div>

	</div>