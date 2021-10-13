<?php

include '../../config.php';
if(isset($_POST['image_id']))
{
    session_start();
    header('Content-Type: application/json; charset=utf-8');

    $img_id = $_POST['image_id'];
    $can_like  =TRUE;
    $sql = "SELECT likes FROM images WHERE id = '$img_id'";
    $res =  mysqli_query($link,$sql);
    $likes = mysqli_fetch_assoc($res)['likes'] + 1;
    
    $username = $_SESSION['username'];
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
        $data = array($img_id,strval($likes));
        $JSON_DATA = json_encode($data);
    
        echo($JSON_DATA);

    }else
    {
        $likes = $likes - 2;
        $sql = "DELETE FROM liked_images WHERE liker_name = '$username' and  liked_image_id = '$img_id'";
        mysqli_query($link,$sql);

        $sql = "UPDATE images SET likes = '$likes' WHERE id = '$img_id'";
        mysqli_query($link,$sql);
        $data = array($img_id,strval($likes));
        $JSON_DATA = json_encode($data);
    
        echo($JSON_DATA);


    }
    //header('Location: home.php');
}

?>