<?php
    // A function to handle username
    function invalidUsername($username){
        // $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }
 
    // A function to handle empty inputs fields
    function emptyInputSignup($username, $password, $passwordRepeat) {
        // $result;
        if(empty($username) || empty($password) ||empty($passwordRepeat)){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }
 
        // a function to handle password match
    function passwordMatch($password, $passwordRepeat) {
        // $result;
        if($password !== $passwordRepeat){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }
 
        // a function to handle existing usernames
    function existingUsername($conn, $username){
        $sql = "SELECT * FROM users WHERE username = ?;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } 
 
        mysqli_stmt_bind_param($stmt, "s",$username);
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
 
    // Creating a new user
    function createUser($conn, $username, $password, $priviledge){
        $sql = "INSERT INTO users(username, pwd,priviledge) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
 
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
 
        mysqli_stmt_bind_param($stmt, "sss", $username, $hashedpassword, $priviledge);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../login.php?error=none");
        exit();
    }
 
 // handling empty fields while logging in
    function emptyInputLogin($username, $password){
        // $result;
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }
 
 // Handling  provided credentials
    function loginUser($conn, $username, $password){
        $usernameExists = existingUsername($conn, $username);
 
        if ($usernameExists === false){
            header("location:../login.php?error=incorrectlogin");
            exit();
        }
 
        $pwdHashed = $usernameExists["pwd"];
 
        $checkpwd = password_verify($password, $pwdHashed);
 
        if($checkpwd === false){
            header("location:../login.php?error=incorrectlogin");
            exit();
        }
        else if ($checkpwd === true){
            session_start();
            $_SESSION["userId"] =  $usernameExists["userid"];
            $_SESSION["userName"] =  $usernameExists["username"];
            if($usernameExists["priviledge"] == '1'){
                $_SESSION["priviledge"] =  $usernameExists["priviledge"];
            }
            header("location:../index.php");
            exit();
 
        }
 
    }