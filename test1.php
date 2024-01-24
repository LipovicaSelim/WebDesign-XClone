<?php include_once("./helpers/TweetRepository.php");?>

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
        <?php include_once("./pages/SideBar.php"); ?>

        <!-- Include main content HTML -->
        <?php include_once("./pages/MainFeed.php"); ?>

    </div>
</body>
<script src="./home.js"></script>
</html>
