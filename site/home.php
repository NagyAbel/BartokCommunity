<?php
	include "../config.php";
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }else if($_SESSION["username"]=="admin")
    {
        header("location: admin.php");

    }
	$username = $_SESSION["username"];
	$sql = "SELECT image_url FROM users WHERE username='$username'";
    $res = mysqli_query($link,  $sql);

	$picture = mysqli_fetch_assoc($res)
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="../static/update.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
          <img src="../profile_pictures/<?=$picture['image_url']?>" alt='IMAGE' width="200" height="200">

    <h1 class="my-5">Hello there, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="../auth/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
	

    <form action = "upload.php" , method  = "post" , enctype="multipart/form-data">

    <input type="file", name="my_image">
    <input type="submit", name="submit", value="Upload">


    </form>
    <div id="view">    <?php include('view.php'); ?>
</div>
</body>
</html>

