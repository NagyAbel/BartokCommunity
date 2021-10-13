<?php
	include "../../config.php";
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../../auth/login.php");
        exit;
    }else if($_SESSION["username"]=="admin")
    {
        header("location: ../../admin/admin.php");

    }
	$username = $_SESSION["username"];
	$sql = "SELECT image_url FROM users WHERE username='$username'";
    $res = mysqli_query($link,  $sql);

	$picture = mysqli_fetch_assoc($res)
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<link rel="shortcut icon" type="image/png" href="../../favicon.png"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../../static/js/like.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="../../static/css/home.css"/>
<link rel="stylesheet" type="text/css" href="../../static/css/background.css"/>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
<script src="../../static/js/heart.js"></script>
<script src="../../static/js/update.js"></script>
</head>
<body>


<!-- Background animtion-->

<?php include('background.html'); ?>

    <?php include('header.php'); ?>

    <?php include('view.php'); ?>

</div>

