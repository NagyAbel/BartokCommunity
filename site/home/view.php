<div id="view"> 
     <?php 
        @include "../../config.php";
		@session_start();

		$username = $_SESSION['username'];
		?>

<!-- DEFAULT DIV START -->
		 <div id="default" class="default scroll">
		<?php
		$sql = "SELECT * FROM images ORDER BY id DESC";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
		
            <div id="image" class="defimages">
				<p class="creatorname"><?=$images['creator_name']?></p>
             	<img src="../../uploads/<?=$images['image_url']?>" alt='IMAGE' class="blacktemple">
				<div class="line"></div>
				<button class="likesbutt" name="submit" value=<?=$images['id']?> type="submit" onClick="likeImage(this.value)">
				<p class=<?=$images['id']?> style="text-align: center;"><?=$images['likes']?>
				<i  style="color: red;position: relative;right: -5%;" class='fas fa-heart'></i></p></button>
					
              </div>
    <?php } }?>
			  </div>
<!-- DEFAULT DIV END -->



<!-- YOUR UPLOADS DIV START -->
<div class="uploads">
<h1 class="bigtext">Feltöltéseid</h1>

<div class="your_uploads scrollb" >

		<?php
		$sql = "SELECT * FROM images WHERE creator_name = '$username' ORDER BY id desc ";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
		
            <div class="defimages">
				<br>
             	<img src="../../uploads/<?=$images['image_url']?>" alt='IMAGE' class="theeye">
				 <form action="../utils/remove_post.php"
           				method="post"
           				enctype="multipart/form-data">	
					<button class="likesbuttb" name="submit" value=<?=$images['id']?> type="submit">törlés</button>
     				</form>
              </div>
    <?php } }?>
			  </div>
			  </div>
<!-- YOUR UPLOADS DIV END -->


<!-- MOST LIKED DIV START -->
<div class="likes">
  <h1 class="bigtextb">Legkedveltebb Képek</h1>

<div class="most_liked scrollb">
		<?php
		$sql = "SELECT * FROM images ORDER BY likes desc  ";
		$res = mysqli_query($link,  $sql);
		  
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) { 
				  if($images['likes']> 0 ){ ?>
		
            <div  class="defimages">
				<p class="creatornameb"><?=$images['creator_name']?><p>
             	<img src="../../uploads/<?=$images['image_url']?>" alt='IMAGE' class="theeye">
				 <div class="line"></div>
				 <button class="likesbutt" name="submit" value=<?=$images['id']?> type="submit" onClick="likeImage(this.value)">
				<p class=<?=$images['id']?> style="text-align: center;"><?=$images['likes']?>
				<i  style="color: red;position: relative;right: -5%;" class='fas fa-heart'></i></p></button>

              </div>
    <?php }} }?>
			  </div>
<!-- MOST LIKED DIV END -->
</div>
</div>

</div>
</body>

</html>
