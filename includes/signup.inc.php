<!-- Sign up functionalities -->
<?php
   // Checking if a user used the submit button

    if(isset($_POST["signup-submit"])){
        
         $username = $_POST["username"];
         $password = $_POST["password"];
         $passwordRepeat = $_POST["passwordRepeat"];

         if(!isset($_POST["priviledge"])){
            $priviledge = 0;
         }else{
            $priviledge = $_POST["priviledge"];
         }

         require_once 'dbh.inc.php';
         require_once 'functions.inc.php';

        //  Error handling

         // Validating the username
         if(invalidUsername($username) !== false){
            header("location:../signup.php?error=invalidUsername");
            exit(); 
         }

         // Handling empty input fields
         if(emptyInputSignup($username, $password, $passwordRepeat) !== false){
            header("location:../signup.php?error=emptyinput");
            exit(); 
         }

         // Handling passwords match
         if(passwordMatch($password, $passwordRepeat) !== false){
            header("location:../signup.php?error=passwordsdontmatch");
            exit(); 
         }


         // Handling taken usernames
         if(existingUsername($conn, $username) !== false){
            header("location:../signup.php?error=usernameExists");
            exit(); 
         }
         // Creating a new user
         createUser($conn, $username, $password,$priviledge);
        
    }
     
    else {
        header("location:../signup.php");   // redirecting to the sign up page
        exit();
    }

    