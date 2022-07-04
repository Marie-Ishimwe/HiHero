<?php
    $id  = $_GET['heroid'];
    
    require_once 'dbh.inc.php';
    require_once 'hero_functions.inc.php';
    // A querry to select information from the database
    $sql = "SELECT image_url FROM hero WHERE heroid=$id";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $file = $row['image_url'];
        if(!empty($file)){
            if (file_exists("../assets/images/hero_images/$file")){
                if (!unlink("../assets/images/hero_images/$file")) { 
                    $em= "image cannot be deleted due to an error";
                    header("Location: ../details.php?error=$em&heroid=$id");
                    exit();
                }
            }
        }
    }

    deleteHero($conn,$id);
    header("Location: ../index.php?error=no_image");  // directing to the home page
    exit();

?>