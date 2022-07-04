<?php
// Checking if the user used login button to access the next pages
if(isset($_POST["login-submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Checking if all fields are filled
    if(emptyInputLogin($username, $password) !== false){
        header("location:../login.php?error=emptyinput");   // redirecting a user to login page
        exit(); 
     }
    //  Log a user in 
     loginUser($conn, $username, $password);
}

else{
    header("location:../login.php");  // redirecting to the login page
    exit();
}

