<?php 
include ("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}



if(isset($_POST['post'])){


$edit = new Post($con, $userLoggedIn);
$edit->updatePost($_POST['edit_text'], $id);
header("Location: index.php");

		
}
?>


	<div class="main_column " id="main_column">
		
		<div class="posts_area">
			<?php 
			$post = new Post($con, $userLoggedIn);
			$post->getSinglePostEdit($id);
			?>
			

		</div>

	</div>