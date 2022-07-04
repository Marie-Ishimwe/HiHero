<?php

// Updating hero's picture
    function updateHeroSameImage($conn, $heroId, $name, $nickname, $short_bio, $long_bio){
        $sql = "UPDATE hero SET nick_name=?,real_name=?,short_bio=?,long_bio=? WHERE heroid = $heroId;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../details.php?error=stmtfailed&heroid=$heroId");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssss", $nickname, $name, $short_bio, $long_bio);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../details.php?error=none&heroid=$heroId");
        exit();
    }
    function updateHero($conn, $heroId, $name, $nickname, $short_bio, $long_bio, $image_url){
        $sql = "UPDATE hero SET nick_name=?,real_name=?,short_bio=?,long_bio=?,image_url=? WHERE heroid = $heroId;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../details.php?error=stmtfailed&heroid=$heroId");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssss", $nickname, $name, $short_bio, $long_bio, $image_url);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../details.php?error=none&heroid=$heroId");
        exit();
    }

    //  Creating an unpdated hero
    function createHero($conn, $name, $nickname, $short_bio, $long_bio, $image_url){
        $sql = "INSERT INTO hero(nick_name,real_name,short_bio,long_bio,image_url) VALUES(?,?,?,?,?);"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssss", $nickname, $name, $short_bio, $long_bio, $image_url);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../index.php?error=none");
        exit();
    }

    // Absence of a hero image
    function createHeroNoImage($conn, $name, $nickname, $short_bio, $long_bio){
        $sql = "INSERT INTO hero(nick_name,real_name,short_bio,long_bio) VALUES(?,?,?,?);"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssss", $nickname, $name, $short_bio, $long_bio);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../index.php?error=none");
        exit();
    }

    // Deleting a hero
    function deleteHero($conn,$heroId){
        $sql = "DELETE FROM hero WHERE heroid=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../details.php?error=stmtfailed&heroid=$heroId");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $heroId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../index.php?error=none");
        exit();
    }
// Handling existance of a hero
    function existingHeroName($conn, $heroName){
        $sql = "SELECT * FROM hero WHERE nick_name = ?;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } 

        mysqli_stmt_bind_param($stmt, "s", $heroName);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
// Handling empty input fields
    function emptyInput($realName, $heroName, $shortBio, $longBio) {
        // $result;
        if(empty($realName) || empty($heroName) || empty($shortBio) || empty($longBio)){
            $result = true;
        }
        else{
            $result = false;
        }

        return $result;
    }
?>