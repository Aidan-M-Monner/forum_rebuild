<?php
    require('config.inc.php');
    require('functions.php');

    if(!logged_in()) {
        header("Location: index.php");
        die;
    }

    $user_id = $_GET['id'] ?? $_SESSION['USER']['id'];
    $query = "select * from users where id = '$user_id' limit 1";
    $row = query($query);

    if($row) {
        $row = $row[0];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Profile - PHP Forum</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="assets/css/class_styles.css">
        <link rel="stylesheet" type="text/css" href="assets/css/extra_styles.css">
    </head>

    <body>
        <section class="class_1">
            <!-- Top Bar ---------------------------------------------->
            <?php include('header.inc.php'); ?>

            <!-- Settings ---------------------------------------------->
            <div class="class_11">
                <div class="class_12">
                    <!-- *Saving Settings ---------------------------------------------->
                    <?php include('success.alert.inc.php'); ?>
                    <?php include('failure.alert.inc.php'); ?>

                    <!-- *Profile ---------------------------------------------->
                    <?php if(!empty($row)):?>
                        <div class="class_19"></div>
                        <div class="class_20">
                            <img src="<?=get_image($row['image'])?>" class="class_21">
                            <div class="class_22">
                                <h1 class="class_23"><?=$row['username']?></h1>
                                <a href="<?=$row['fb']?>"><i class="bi bi-facebook class_24"></i></a>
                                <a href="<?=$row['tw']?>"><i class="bi bi-twitter class_24"></i></a>
                                <a href="<?=$row['yt']?>"><i class="bi bi-youtube class_24"></i></a>
                                <div class="class_15"> <?=htmlspecialchars($row['bio'])?></div>
                            </div>

                            <?php if(i_own_profile($row)):?>
                                <a href="profile-settings.php"><button class="class_39">Edit Profile</button></a>
                                <button class="class_39" onclick="user.logout()">Logout</button>
                            <?php endif;?>

                            <div style="clear: both"></div>
                        </div>
                    <?php else:?>
                        <div class="class_16">
                            <i class="bi bi-exclamation-circle-fill class_14"></i>
                            <div class="class_15">Profile not found!</div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <!-- Signup ---------------------------------------------->
            <?php include('signup.inc.php') ?>

        </section>
    </body>
</html>