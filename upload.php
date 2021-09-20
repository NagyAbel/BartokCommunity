<?php

if(isset($_POST['submit']) && isset($_FILES['my_image'])){
    include "../config.php";
    session_start();
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
	$img_creator =$_SESSION['username'];
    $img_likes = 0;
    $date = date('y-m-d');
    $error = $_FILES['my_image']['error'];
    if($error === 0)
    {
        if($img_size > 28000)
        {
            $em = "Sorry, your file is too large.";
            header("Location: home.php?error=$em");
        }else
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg","jpeg","png");

            if(in_array($img_ex_lc, $allowed_exs))
            {
                $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = '../uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                // Insert into Database
                $sql = "INSERT INTO images(creator_name,created_date,image_url,likes)
                 VALUES('$img_creator','$date','$new_img_name','$img_likes')";
                mysqli_query($link,$sql);
              

                header("Location: home.php");


            }else
            {
                $em = "You can't upload files of this type";
		        header("Location: home.php?error=$em");

            }
        }
    }else
    {
        $em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

    }else
    {
        header("Location: home.php");

    }


?>