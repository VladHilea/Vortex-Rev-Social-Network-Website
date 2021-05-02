<?php 
include ("includes/header.php");

if(isset($_GET['tag'])) {
	$tag = $_GET['tag'];
}
else {
	$tag = 0;
}





?>
<div class="profile_left" >
		<h4 class="text-center word_title">
		<?php 

		$tag_title = strtoupper($tag);
		echo "#". $tag_title;
		?>
			
		</h4>
</div>

	<div class="main_column" id="main_column">
		
		<div class="posts_area">

			
		</div>
		<img id="loading" src="assets/images/icons/loading.gif">

	</div>

	<script>
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';
		var tag = '<?php echo $tag; ?>';
		

	$(document).ready(function() { 


		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_tags_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn + "&tag1=" + "#" + tag   ,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
		//$('#load_more').on("click", function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
			//if (noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_tags_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&tag1=" + "#" + tag  ,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});
	</script>