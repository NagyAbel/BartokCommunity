<!DOCTYPE html>
<html>

<body>
     <?php 


        
    
            include "../config.php";
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

</body>
</html>
