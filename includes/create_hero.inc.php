<?php
    require_once 'dbh.inc.php';
    require_once 'hero_functions.inc.php';

    if(isset($_POST["submit_hero"]) && isset($_FILES['image']) && $_FILES['image']['size'] != 0){
        $heroName = $_POST['nick_name'];
        $realName = $_POST['name'];
        $shortBio = $_POST['short_bio'];
        $longBio = $_POST['long_bio'];
        // $image_url = $_POST['image_url'];

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
         
        if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/images/hero_images/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                createHero($conn, $realName, $heroName, $shortBio, $longBio, $new_img_name);
                header("Location: ../index.php?error=$em");
                exit();
            }
            else {
                $em = "You can't upload files of this type $img_ex_lc";
                header("Location: ../index.php?error=$em");
                exit();

            }
        }else{
            $em = "unknown error occurred!";
            header("Location: ../index.php?error=$em");
            exit();
        }

        


    }
    elseif(isset($_POST["submit_hero"])){
        $heroName = $_POST['nick_name'];
        $realName = $_POST['name'];
        $shortBio = $_POST['short_bio'];
        $longBio = $_POST['long_bio'];
        createHeroNoImage($conn, $realName, $heroName, $shortBio, $longBio);
        header("Location: ../index.php?error=$em");
        exit();
    }
    else{
        header("Location: ../index.php?error=submit_failed");
        exit();
    }
?>