
<div class="header">
    <button class=" button" onclick="location.href='uploadview.php';" style="color: white;">Feltöltés</button>

        <p href="home.php" class="title" style="color: white;">Bartók Community</p>


        
        <div href="home.php" class="dropdown">
            <img src="../../profile_pictures/<?=$picture['image_url']?>" alt='IMAGE' class="img">
            <p class="username"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                <div class="dropdown-content">  
                    <img src="../../profile_pictures/<?=$picture['image_url']?>" alt='IMAGE' class="hover_img">
                    <p class="hover_username"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    <input type="button" onclick="location.href='about_us.php';" value="Rólunk" style="  font-family: 'Staatliches', cursive; letter-spacing:2px;" class="about_us_button" />
                    <input type="button" onclick="location.href='../../auth/logout.php';" value="Kijelentkezés" style="  font-family: 'Staatliches', cursive; letter-spacing:2px;" class="sign_out_button" />
                </div>
        </div>



</div>


