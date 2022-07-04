<?php
    $id  = $_GET['heroid'];
    if(isset($_POST["submit_update"]) && isset($_FILES['image'])){
        $heroName = $_POST['nick_name'];
        $realName = $_POST['name'];
        $shortBio = $_POST['short_bio'];
        $longBio = $_POST['long_bio'];
        // $image_url = $_POST['image_url'];

        require_once 'dbh.inc.php';
        require_once 'hero_functions.inc.php';

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if(file_exists("../assets/images/hero_images/$img_name")){
            updateHeroSameImage($conn, $id, $realName, $heroName, $shortBio, $longBio);
            header("Location: ../details.php?error=$em&heroid=$id");
            exit();
        }

        if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../assets/images/hero_images/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                updateHero($conn, $id, $realName, $heroName, $shortBio, $longBio, $new_img_name);
                header("Location: ../details.php?error=$em&heroid=$id");
                exit();
            }else {
                $em = "You can't upload files of this type $img_ex_lc";
                header("Location: ../details.php?error=$em&heroid=$id");
                exit();
            }
        }else{
            $em = "unknown error occurred!";
            header("Location: ../details.php?error=$em&heroid=$id");
            exit();
        }
    }elseif(isset($_POST["submit_update"])){
        $heroName = $_POST['nick_name'];
        $realName = $_POST['name'];
        $shortBio = $_POST['short_bio'];
        $longBio = $_POST['long_bio'];
        updateHeroSameImage($conn, $id, $realName, $heroName, $shortBio, $longBio);
        header("Location: ../details.php?error=$em&heroid=$id");
        exit();
    }else{
        header("Location: ../details.php?error=submit_failed&heroid=$id");
        exit();
    }
?>