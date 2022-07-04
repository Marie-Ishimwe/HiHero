<!-- Connection to the database -->
<?php
	include_once './includes/dbh.inc.php'; ?>

<!-- HTML beginning -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- link to the CSS file -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Sign up for section -->
    <div class="container">
        <form action="includes/signup.inc.php" method ="POST" class="login_form">
            <!-- Title of the form -->
            <Login class="login-text"><a href="index.php">HiHero</a> Sign up</p>
            <!-- username -->
            <div class="input-group">
                <input type="text" placeholder ="Username" name ="username" >
            </div>
            <!-- password -->
            <div class="input-group">
            <input type="password" placeholder ="Password" name ="password">
            </div>
            <!-- confirm password -->
            <div class="input-group">
            <input type="password" placeholder ="Confirm Password" name ="passwordRepeat" >
            </div>
            <!-- setting new user's priviledges -->
            <label for="priviledge"style="display: flex;">
            <div class="input-group">
            <input type="checkbox" name="priviledge" id="Priviledge" value="1" style="height: 20px; width:50px;">
            </div>
             <h4 style="font-size:small; margin-right:90%;">Admin?</h4>  
            </label>
            <!-- Sign up button -->
            <div class="input-group">
                <button class ="btn" type ="submit" name ="signup-submit">Sign up</button>
            </div>
            <!-- Message to take a user to login page -->
            <!-- <p class="register-account">Have an account? <a href="login.php">Login</a>.</p> -->

        </form>
        <!-- Possible errors -->
        <?php
        // Communicating that all fields aint filled
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<p>All fields must be filled! </p>";
                }

                // communicating that the username already exists
                else if ($_GET["error"] == "invalidUsername"){
                    echo "<p>Invalid username!</p>";
                }

                // Communicating that passwords don't match
                else if ($_GET["error"] == "passwordsdontmatch"){
                    echo "<p>Passwords don't match!</p>";
                }

                // Communicating that username is taken
                else if ($_GET["error"] == "usernameExists"){
                    echo "<p>Username already exists!</p>";
                }

                // Communicating that something went wrong
                else if ($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again!</p>";
                }

                // Successfully signed up
                else if ($_GET["error"] == "none"){
                    echo "<p>You have signed up!</p>";
                }
            }
        ?>
    </div>
</body>
</html>

