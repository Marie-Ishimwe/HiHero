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
    <!-- Login in section -->
    <div class="container">
        <form action="includes/login.inc.php" class="login_form" method="POST">
            <!-- Title of the form -->
            <p class="login-text"><a href="index.php">HiHero</a> Login</p>
            <!-- username -->
            <div class="input-group">
                <input type="text" placeholder ="Username" name ="username">
            </div>
            <!-- password -->
            <div class="input-group">
            <input type="password" placeholder ="Password" name ="password">
            </div>
            <!-- login button -->
            <div class="input-group">
                <button class ="btn" name ="login-submit">Login</button>
            </div>
            <!-- message to sign up for a user without an account -->
            <!-- <p class="register-account">Don't have an account? <a href="signup.php">Register Here</a>.</p> -->
        </form>
 
        <!-- Possible errors -->
        <?php
        // empty fields
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<p>All fields must be filled!</p>";
                }
        // incorrect username OR password
                else if ($_GET["error"] == "incorrectlogin"){
                    echo "<p>Incorrect username or password!</p>";
                }
            }
        ?>
    </div>
</body>
</html>