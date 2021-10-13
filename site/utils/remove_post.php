<?php 

include '../../config.php';
if(isset($_POST['submit']))
{
    session_start();
    $img_id = $_POST['submit'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM images WHERE id = '$img_id'";
    $res = mysqli_query($link,$sql);
    $img_data  = mysqli_fetch_array($res);
    $img_username = $img_data['creator_name'];
    $img_url = $img_data['image_url'];
    if($img_username == $username or $username == "admin")
    {
        $sql = "DELETE FROM images where id = '$img_id'";
        $res = mysqli_query($link,$sql);
        unlink("../uploads/$img_url");
        $sql = "DELETE FROM liked_images where liked_image_id = '$img_id'";
        $res = mysqli_query($link,$sql);
      
        header('location: ../home/home.php');

    }else
    {
        echo('USERNAME ERROR');
    }
    

}
?>