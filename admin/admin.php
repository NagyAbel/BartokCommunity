

<?php 
    session_start();
    include '../config.php';

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
    <h1 class="my-5"> ADMIN PAGE</h1>
    <p>
        <a href="../auth/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <form action = "upload.php" , method  = "post" , enctype="multipart/form-data">

    <input type="file", name="my_image">
    <input type="submit", name="submit", value="Upload">


    </form>
</div>
</body>
</html>
    
<?php
    if(isset($_SESSION["loggedin"]))
    {
        $username = $_SESSION['username']; 
        if(!$username == "admin")
        {
            echo('You are not an admin');
        }else
        {
            include('admin_view.php');
        }
        
    }else
    {
        echo('You are not logged in');
    }
    ?>
