<?php 

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
    <title>DxS</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
</head>
<body>
    

    <div class="screen-ctn">
        <!-- Include sidebar HTML -->
        <?php include_once("SideBar.php"); ?>

        <!-- Include main content HTML -->
        <?php include_once("MainFeed.php"); ?>

    </div>
</body>
<script src="./home.js"></script>
</html>
