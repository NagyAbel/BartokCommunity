<?php

include '../config.php';
if(isset($_POST['submit']))
{
    session_start();

    $img_id = $_POST['submit'];
    $can_like  =TRUE;
    $sql = "SELECT likes FROM images WHERE id = '$img_id'";
    $res =  mysqli_query($link,$sql);
   //$likes = mysqli_fetch_assoc($res)['likes'];
    $likes = mysqli_fetch_assoc($res)['likes'] + 1;
    $username = $_SESSION['username'];
    $sql = "SELECT  liked_image_id FROM liked_images WHERE liker_name = '$username'";
    $res = mysqli_query($link,$sql);
    $i = 0;
    $list = mysqli_fetch_array($res);
    if(!is_null($list))
    {
        while($i < count($list))
        {
            if($list[$i] == $img_id)
            {
                $can_like = FALSE;
            }
            $i++;
        }
    }
 
   


    if($can_like)
    {
        $sql = "INSERT INTO liked_images(liker_name, liked_image_id)
        VALUES('$username','$img_id')";    
        mysqli_query($link,$sql);

        $sql = "UPDATE images SET likes = '$likes' WHERE id = '$img_id'";
        mysqli_query($link,$sql);


    }
    header('Location: home.php');
}

?>