<!-- Starting a session -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/details.css">
</head>
<body>
    <!-- top button to direct to the previous page -->
    <div class="top_buttons">
        <div class="back">
            <a class="back_button" href="index.php">&#8676;</a>
        </div>
        <?php
        if(isset($_SESSION["userId"])){
        ?>
        <div class="edit">
            <a href="#container" class="edit_button">
                <!-- <img src="assets/images/icons8-edit-96.png" alt="edit"> -->
                &#x270E;
            </a>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
	    include_once './includes/dbh.inc.php';
        $id = $_GET['heroid'];
        $sql = "SELECT * FROM hero WHERE heroid=$id";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        // print_r($row);

        $heroName = $row['nick_name'];
        $realName = $row['real_name'];
        $shortBio = $row['short_bio'];
        $longBio = $row['long_bio'];
        $image_url = $row['image_url'];

    ?>
    <!-- displaying the details of a selected hero -->
    <div class="content center">
        <div class="image">
            <img class="hero_image" name="hero_img" src="assets/images/hero_images/<?php echo $image_url; ?>">
        </div>
        <div class="bio">
            <h4 class="nickname_name name"><?php echo $heroName; ?></h4>
            <h4 class="real_name name"><?php echo $realName; ?></h4>
            <p class="short_bio bio_text"><?php echo $shortBio; ?></p>
            <p class="long_bio bio_text"><?php echo $longBio; ?></p>
            <?php
            if(isset($_SESSION["userId"])){
            ?>
            <div class="delete_div">
                <a href="./includes/delete.inc.php?heroid=<?php echo $id ?>" class="btn" style="color: red; width:fit-content">DELETE</a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
        if(isset($_SESSION["userId"])){
    ?>

    <!-- Upating a hero section -->
    <div id="container" class="container">
        <form action="./includes/update.inc.php?heroid=<?php echo $id ?>" method="post" enctype="multipart/form-data" class="login_form">
            <!-- title of the form -->
            <p class="login-text">Edit hero</p>

            <!-- hero image -->
            <div class="input-group">
                <input type="file" name="image" class="form-input" accept="image/*" value="<?php echo $_FILES["assets/images/hero_images/$image_url"]; ?>" >
            </div>

            <!-- hero's real names -->
            <div class="input-group">
                <input type="text" class="form_text form-input" name="name" value="<?php echo $realName; ?>">

            </div>

            <!-- hero's nick name -->
            <div class="input-group">
                <input type="text" name="nick_name" class="form_text form-input" value="<?php echo $heroName; ?>">
            </div>

            <!-- short bio -->
            <div class="input-group">
                <textarea type="text" name="short_bio" cols="30" rows="5"><?php echo $shortBio; ?></textarea>
            </div>

            <!-- long bio -->
            <div class="input-group">
                <textarea name="long_bio" id="long_input" cols="30" rows="10"><?php echo $longBio; ?></textarea>
            </div>

            <!-- submit button -->
            <div class="input-group">
                <button class ="btn" type ="submit" name ="submit_update">Submit</button>
            </div>
        </form>
        <a href="#"><span class="close">&#10006;</span></a>
    </div>
    <?php
        }
    ?>
</body>
</html>
