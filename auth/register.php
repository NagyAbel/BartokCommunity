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
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
				//header("location: profile_view.php");
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
    <title>Sign Up</title>
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

        .textsugi{
            position: absolute;
            top: 100%;
            left: 15%;
            text-align: center;
            color: rgba(0, 0, 0, 0.5);
            font-size: 25px;
            width: 70%;
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
        body{
            background: #2C3034;
        }
    </style>
</head>
<body>
    <p class="title2" >PixelGram</p>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" placeholder="username" class="text <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <input type="password" name="password" placeholder="password" class="text <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <input type="password" name="confirm_password" placeholder="confirm password" class="text <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <input type="submit" class="button" value="Sign Up">
            <p class="textsugi">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>