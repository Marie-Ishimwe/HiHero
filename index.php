<?php
    session_start();   // stating a session
	include_once './includes/dbh.inc.php';     // connecting to the database
    $result = mysqli_query($conn, "SELECT * FROM hero;"); // querry to extract information from the database
    ?>
 
<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
     <!-- link to the CSS file -->
     <link rel="stylesheet" href="assets/css/global.css">
     <link rel="stylesheet" href="assets/css/index_style.css">

     <!-- Java script -->
     <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
     <!-- Link to Jquery -->
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script>
         $(document).ready(function(){
             $('#icon').click(function(){
                $('ul').toggleClass('show');   //activating an icon
             });
         });
 
     </script>
 
 
    </head>
<body>
    <!-- Navigation bar -->
    <nav>
        <label id="icon">
            <i class="fas fa-bars"></i>
        </label>
        <label class = "logo"><a href="index.php" style="all: unset; cursor:pointer;">HiHero</a></label>
        <ul>
            <!-- changing the navigation bar when a user has logged in -->
            <?php
                if(isset($_SESSION["userId"])){
                    ?>
                        <li><a class =" nav-links" href="#"><?php echo $_SESSION["userName"]?></a></li>
                        <?php
                        if(isset($_SESSION["priviledge"])){
                        ?>
                        <li><a class =" nav-links" href="signup.php">New User</a></li>
                        <?php
                        }
                        ?>
                        <li><a class ="nav-links" href="includes/logout.inc.php">Logout</a></li>
                    <?php
                }
                else{
                    ?>
                    <!-- <li><a class =" nav-links active" href="index.php">Home</a></li> -->
                    <li><a class =" nav-links" href="login.php">Login</a></li>
                    <?php
                }
            ?>
        </ul>
    </nav>
    <!-- When there is not hero in the database -->
    <!-- diaplaying heroes in the database -->
    <div id="heroes">
        <div class="heroes-container">
        <?php
            if (mysqli_num_rows($result) === 0) {
            if(isset($_SESSION["userId"])){
        ?>
        <!-- button to create a new hero -->
            <a class ="btn" href="#container" name="create">CREATE HERO</a> 
        <?php
            }else{
        ?>
            <h1>NO HEROES YET!</h1>
            <?php
                } } else { 
                    ?>
                    <!-- When we have heroes in the database -->
                    <ul class="heroes-list">
                    <?php
                    //Storing dtabase information in an array and looping thorugh the array to display database information
                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>
                            <li class="hero">
                                <a href="details.php?heroid=<?php echo $row['heroid']?>">
                                    <img class="hero-image" src="assets/images/hero_images/<?php echo $row['image_url']?>" alt="">
                                    <h3 class="hero-name"><?php echo $row['nick_name']?></h3>
                                    <p class="hero-caption"><?php echo $row['short_bio']?></p>
                                </a>
                            </li>
                        <?php
                    }
                    ?>
            </ul>
                    <!-- create hero button -->
            <?php
            if(isset($_SESSION["userId"])){
            ?>
            <a class ="btn" href="#container" name="create" style=" width:10vw; float:right; bottom:8vh; right:0; position:fixed;">CREATE HERO</a>
                 <?php
                }
                 } 
                    ?>
        </div>
    </div>

    <!-- SECTION for creating a new hero -->
    <div class="container" id="container">
        <form action="./includes/create_hero.inc.php" method="post" enctype="multipart/form-data" class="login_form">
            <!-- name of the form -->
            <p class="login-text">Create a hero</p>
                 <!-- picture of the hero -->
                <div class="input-group">
                    <input type="file" name="image" accept="image/*" name="name">
                </div>

                <!-- Hero actual name -->
                <div class="input-group">
                    <input type="text" class="form_text" name="name" placeholder="Real name" required>
                </div>

                <!-- hero nick name -->
                <div class="input-group">
                    <input type="text" name="nick_name" class="form_text" placeholder="nickname" required>
                </div>

                <!-- short bio -->
                <div class="input-group">
                    <textarea type="text" name="short_bio" cols="30" rows="5" placeholder="Short bio" required></textarea>
                </div>

                <!-- long bio -->
                <div class="input-group">
                    <textarea name="long_bio" id="long_input" cols="30" rows="10" placeholder="Long bio" required></textarea>
                </div>

                <!-- submit button -->
                <div class="input-group">
                    <button class ="btn" type ="submit" name ="submit_hero">Submit</button>
                </div>
        </form>
        <a href="#"><span class="close">&#10006;</span></a>
    </div>
</body>
</html>