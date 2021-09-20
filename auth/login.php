<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION['username'] == "admin")
    {

        header("location: ../site/admin.php");

    }else
    {
        header("location: ../site/home.php");

    }

    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            if($_SESSION["username"] == "admin")
                            {
                                header("location: ../site/admin.php");

                            }else
                            {
                                header("location: ../site/home.php");

                            }
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="agyfasz.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');
        @font-face {
            font-family: 'fffforward';
            src: url('../static/fonts/fffforward.TTF') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body{
            background: #2C3034;
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
            top: 55%;
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

        .textsugi{
            position: absolute;
            top: 72%;
            left: 20%;
            text-align: center;
            color: rgba(0, 0, 0, 0.5);
            font-size: 25px;
            width: 60%;
            text-align: center;
        }

        a {
            color: #ffffff;
        }

        .title2 {
            text-align: center;
            margin-top: 10%;
            font-size: 60px;
            font-family: 'fffforward';
            color: #D4D7DF;
        }
        
    </style>
</head>
<body>
    <p class="title2" >PixelGram</p>

    <div class="wrapper">
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username"  placeholder="username" class="text <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <input type="password" name="password" placeholder="password" class="text <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <input type="submit" class="button" value="Login">
            <p class="textsugi">Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>