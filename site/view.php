<!DOCTYPE html>
<html>

<body>
     <?php 
        include "../config.php";
		@session_start();

		$username = $_SESSION['username'];
		?>


<!-- DEFAULT DIV START -->
		 <div id="default">
		<?php
		$sql = "SELECT * FROM images ORDER BY id DESC";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
            </br>
		
            <div id="image">
				<p><?=$images['likes']?>,    creator: <?=$images['creator_name']?><p>
             	<img src="../uploads/<?=$images['image_url']?>" alt='IMAGE' width="200" height="200">
				 <form action="like.php"
           				method="post"
           				enctype="multipart/form-data">	
					<button name="submit" value=<?=$images['id']?> type="submit">Like</button>
					<br>
     				</form>
			<br>
			<br>
			<br>
              </div>
    <?php } }?>
			  </div>
<!-- DEFAULT DIV END -->



<!-- YOUR UPLOADS DIV START -->
<div class="your_uploads" >
	<h1>Your Uploads</h1>

		<?php
		$sql = "SELECT * FROM images WHERE creator_name = '$username' ORDER BY id desc ";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
            </br>
		
            <div id="image">
				<p><?=$images['likes']?>,    creator: <?=$images['creator_name']?><p>
             	<img src="../uploads/<?=$images['image_url']?>" alt='IMAGE' width="200" height="200">
				 <form action="remove_post.php"
           				method="post"
           				enctype="multipart/form-data">	
					<button name="submit" value=<?=$images['id']?> type="submit">Remove</button>
					<br>
     				</form>
			<br>
			<br>
			<br>
              </div>
    <?php } }?>
			  </div>
<!-- YOUR UPLOADS DIV END -->



<!-- MOST LIKED DIV START -->
<div class="most_liked">
  <h1>Most Liked</h1>

		<?php
		$sql = "SELECT * FROM images ORDER BY likes desc  ";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
            </br>
		
            <div id="image">
				<p><?=$images['likes']?>,    creator: <?=$images['creator_name']?><p>
             	<img src="../uploads/<?=$images['image_url']?>" alt='IMAGE' width="200" height="200">
				 <form action="like.php"
           				method="post"
           				enctype="multipart/form-data">	
					<button name="submit" value=<?=$images['id']?> type="submit">Like</button>
					<br>
     				</form>
			<br>
			<br>
			<br>
              </div>
    <?php } }?>
			  </div>
<!-- MOST LIKED DIV END -->



			  <style>
			.your_uploads{
				
				float:right;
		}
		.most_liked{
			float:left;
		}
 
    </style>
</body>
</html>
