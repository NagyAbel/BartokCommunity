<?php

include '../config.php';
if(isset($_POST['submit']))
{
    session_start();

    $img_id = $_POST['submit'];
    $can_like  =TRUE;
    $sql = "SELECT likes FROM images WHERE id = '$img_id'";
    $res =  mysqli_query($link,$sql);
    $likes = mysqli_fetch_assoc($res)['likes'] + 1;
    
    $username = $_SESSION['username'];
    echo($username);
    $sql = "SELECT  id FROM liked_images WHERE liker_name = '$username' AND  liked_image_id='$img_id'";
    $res = mysqli_query($link,$sql);
    $list = mysqli_fetch_assoc($res);
    if(!is_null($list))
    {

        $can_like = FALSE;
        
    }
 
   


    if($can_like)
    {
        $sql = "INSERT INTO liked_images(liker_name, liked_image_id)
        VALUES('$username','$img_id')";    
        mysqli_query($link,$sql);

        $sql = "UPDATE images SET likes = '$likes' WHERE id = '$img_id'";
        mysqli_query($link,$sql);


    }else
    {
        $likes = $likes - 2;
        $sql = "DELETE FROM liked_images WHERE liker_name = '$username' and  liked_image_id = '$img_id'";
        mysqli_query($link,$sql);

        $sql = "UPDATE images SET likes = '$likes' WHERE id = '$img_id'";
        mysqli_query($link,$sql);


    }
    header('Location: home.php');
}

?>