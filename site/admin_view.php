
<?php
    @session_start();
    if(isset($_SESSION["loggedin"]))
    {
        $username = $_SESSION['username']; 
        if(!$username == "admin")
        {
            echo('You are not an admin');
            header('location: ../index.php');
        }
        
    }else
    {
        header('location: ../index.php');

    }
    
    ?>
<div class="your_uploads">
		<?php
      

        
		$sql = "SELECT * FROM images  ORDER BY id desc ";
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
        <?php } } ?>
			  </div>
