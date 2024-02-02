<?php
include '../controllers/protected.php';
// session_start();
$getTweetsFromAccountsFollow = "SELECT tweets.tweet_id, Tweets.perdoruesi_id, Tweets.tweet_body
 FROM perdoruesit JOIN ndjeket ON perdoruesit.perdoruesi_id = ndjeket.ndjekesi_id 
 JOIN Tweets ON ndjeket.ndjek_id = Tweets.perdoruesi_id 
 WHERE perdoruesit.perdoruesi_id = 1 
 ORDER BY `Tweets`.`krijuar_me` ASC;"
    ?>
<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XClone</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png" />
    <link rel="manifest" href="favicon_package_v0.16/site.webmanifest" />
    <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5" />
</head>

<body>


    <div class="screen-ctn">
        <!-- Include sidebar HTML -->
        <?php include("SideBar.php"); ?>

        <!-- Include main content HTML -->
        <?php include_once("MainFeed.php"); ?>

    </div>
</body>
<script src="./home.js"></script>
<script>
    console.log("User ID from session: ", <?php echo json_encode($_SESSION['user_id']); ?>);
</script>

</html>