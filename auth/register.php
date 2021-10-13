<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "A felhasználónév nem lehet üres.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "A felhasználónév csak betüket,számokat és alsóvonalakat tartalmazhat.";
    }elseif(strlen($_POST["username"]) > 12)
    {
        $username_err = "A felhasználonév nem lehet hosszabb mint 12 karakter.";

    }else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = strtoupper(trim($_POST["username"]));
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Felhasználónév már foglalt.";
                } else{
                    $username = strtoupper(trim($_POST["username"]));
                }
            } else{
                echo "Hoppá! valami nem működött. Kérlek próbáld újra később.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //Get IP ADDRESS
    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "A jelszó nem lehet üres.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A jelszó legalább 6 karakter hosszú kell legyen.";
    } else{
        $password = strtoupper(trim($_POST["password"]));
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "erősítsd meg a jelszavad.";     
    } else{
        $confirm_password = strtoupper(trim($_POST["confirm_password"]));
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Nem ugyanaz a jelszó";
        }
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password,join_date,ip) VALUES (?, ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password,$date,$ip);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $date  = date("Y/m/d");
            $ip = getIPAddress();
            $sql = "SELECT ip FROM banned_ip WHERE ip = '$ip'";
            $res = mysqli_query($link,  $sql);
            $test = mysqli_fetch_assoc($res);
            
            // Attempt to execute the prepared statement
            if(is_null($test) && mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
				//header("location: profile_view.php");
            } else{
                echo "Hoppá! valami nem működött. Kérlek próbáld újra később.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" type="text/css" href="../static/css/background.css"/>
    <?php include('../site/home/background.html'); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        @font-face {
            font-family: 'fffforward';
            src: url('../static/fonts/fffforward.TTF') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        .wrapper{ 
            width: 30%;
            position: absolute;
            left: 35%;
            top: 35%; 
            text-align: center;
            height: 450px;
            font-family: 'Staatliches', cursive;
        }

        .text {
            text-align: center;
            background: #2C2B2B;
            margin-top: 30px;
            width: 90%;
            height: 60px;
            border-radius: 1000px;
            font-size: 40px;
            border: none;
            box-shadow: 2px 2px 3px #1c1b1b;
            font-family: 'Staatliches', cursive;
            transition: 0.4s ease-in-out;
            color: #979797;
            letter-spacing: 1px;
        }

        .text:focus {
            outline: none;
            width: 93%;
        }

        .button {
            position: absolute;
            left: 25%;
            top: 78%;
            width: 50%;
            background: #2C2B2B;
            border: none;
            border-radius: 1000px;
            height: 50px;
            font-family: 'Staatliches', cursive;
            color: #979797;
            font-size: 30px;
            transition: 0.4s ease-in-out;
        }

        .button:hover {
            box-shadow: 3px 3px 4px #1c1b1b;
            width: 55%;
            height: 52px;
            left: 22.5%;
            font-size: 33px;
        }

        .info{
            position: absolute;
            top: 100%;
            left: 15%;
            text-align: center;
            color: rgba(0, 0, 0, 0.5);
            font-size: 25px;
            width: 70%;
            text-align: center;
            letter-spacing:0.6px;

        }

        a {
            color: #ffffff;
        }

        .title2 {
            text-align: center;
            margin-top: 10%;
            font-size: 100px;
            font-family: 'Staatliches', cursive;
            color: #D4D7DF;
        }
        body{
            background: #2C3034;
        }

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        @media only screen and (max-width: 1200px) {
        body{
            background: #2C3034;
        }

            .wrapper{ 
            width: 80%;
            position: absolute;
            left: 10%;
            top: 35%; 
            text-align: center;
            height: 450px;
            font-family: 'Staatliches', cursive;
        }

        .text {
            text-align: center;
            background: #2C2B2B;
            margin-top: 30px;
            width: 90%;
            height: 60px;
            border-radius: 1000px;
            font-size: 40px;
            border: none;
            box-shadow: 2px 2px 3px #1c1b1b;
            font-family: 'Staatliches', cursive;
            transition: 0.4s ease-in-out;
            color: #979797;
            letter-spacing: 1px;
        }

        .text:focus {
            outline: none;
            width: 93%;
        }

        .button {
            position: absolute;
            left: 25%;
            top: 78%;
            width: 50%;
            background: #2C2B2B;
            border: none;
            border-radius: 1000px;
            height: 50px;
            font-family: 'Staatliches', cursive;
            color: #979797;
            font-size: 30px;
            transition: 0.4s ease-in-out;
        }

        .button:hover {
            box-shadow: 3px 3px 4px #1c1b1b;
            width: 55%;
            height: 52px;
            left: 22.5%;
            font-size: 33px;
        }

        .info{
            position: absolute;
            top: 100%;
            left: 5%;
            text-align: center;
            color: rgba(0, 0, 0, 0.5);
            font-size: 20px;
            width: 90%;
            text-align: center;
            letter-spacing:0.6px;
        }

        a {
            color: #ffffff;
        }

        .title2 {
            text-align: center;
            margin-top: 10%;
            font-size: 100px;
            font-family: 'Staatliches', cursive;
            color: #D4D7DF;
        }
    }
    </style>
</head>
<body>
    <p class="title2" >Bartók Community</p>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" placeholder="felhansználónév" class="text" value="<?php echo $username; ?>">
                <input type="password" name="password" placeholder="jelszó" class="text " value="<?php echo $password; ?>">
                <input type="password" name="confirm_password" placeholder="jelszó megerősítés" class="text" value="<?php echo $confirm_password; ?>">
                </br>
                <?php echo ($username_err); ?>
                <?php echo ($password_err) ; ?>
                <?php echo ($confirm_password_err); ?>

                <input type="submit" class="button" value="regisztráció">

            <p class="info">Van már fiókod? <a href="login.php" style="opacity:88%;"> Bejelentkezés!</a>.</p>
        </form>
    </div>    
</body>
</html>