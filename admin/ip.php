<?php  
    include "../config.php";
    session_start();
    
    if(isset($_POST["ip"]))
    {
        $ip = $_POST["ip"];
        echo($ip);
        $sql = "INSERT  INTO banned_ip(ip) VALUES('$ip')";
		$res = mysqli_query($link,  $sql);

        $sql = "DELETE FROM users WHERE ip = '$ip'";
		$res = mysqli_query($link,  $sql);

    }

?>  

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="ip"  placeholder="username" class="text">
                <input type="submit" class="button" value="ban">
        </form>
