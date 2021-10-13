<?php
include 'ImageResize.php';
use  \Gumlet\ImageResize;
session_start();
include "../../config.php";

 if(isset($_POST['submit']) and isset($_SESSION['loggedin']))
 {
     $filename = $_FILES['my_image']['name'];
     $temp_name = $_FILES['my_image']['tmp_name'];
     $filesize = $_FILES['my_image']['size'];
    $uploaddir = "../../uploads/";
    $targetfile = $uploaddir.$filename;
    $details = getImageSize($_FILES['my_image']['tmp_name']);
    $img_creator = $_SESSION['username'];
    $img_likes = 0;
    $date = date('y-m-d');
    $max_resolution = 400;
     if($filesize > 0 and $filesize < 50000000)
     {
         
        $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg","jpeg","png");
        $resizeimage =uniqid("IMG-",true).'.'.$img_ex_lc;

         if(in_array($img_ex_lc, $allowed_exs))
         {
    
    
            if(move_uploaded_file($temp_name,$targetfile))
            {

                $ratio = $max_resolution / $details[0];
                $new_width = $max_resolution;
                $new_height = $details[1] * $ratio;
                if($new_height > $max_resolution)
                {
                    $ratio = $max_resolution / $details[1];
                    $new_height = $max_resolution;
                    $new_width = $details[0] * $ratio;
                }

                $image = new ImageResize($targetfile);
                $image->resize( $new_width,$new_height);
                $image->save($uploaddir.$resizeimage);
                echo('SUCCES');
                unlink("$targetfile");
                
    
                $sql = "INSERT INTO images(creator_name,created_date,image_url,likes)
                     VALUES('$img_creator','$date','$resizeimage','$img_likes')";
                    mysqli_query($link,$sql);
                    header("Location: ../home/home.php");
    
            }else
            {
            $em = "unknown error occurred!";
            $_SESSION['em'] = $em;
            header("Location: error.php");
            }
    
        }else
        {
            $em = "You can't upload files of this type";
            $_SESSION['em'] = $em;
            header("Location: error.php");
         }

    }else
     {
        $em = "Bocsi, túl nagy a kép.";
        $_SESSION["em"] = $em;
        header("Location: error.php ");
     }
 }


?>