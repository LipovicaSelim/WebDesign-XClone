<?php
include_once("../helpers/DbConnection.php");
// Mock post data
$post = array(
    'post_id' => 3,
    'content' => 'This is a sample post content.',
);

// Handle the like action
if (isset($_POST['like'])) {
    // Add your database logic to insert the like
    $intType = 1;
    $tweet_id = $_POST["post_id"];
    $user_id = 3; // session user
    $tempDb = new DbConnection();
    $dbConnection = $tempDb->dbConnect();
     $sql = "INSERT INTO pelqimet (interaksioni_id,tweet_id, userLikes_id) VALUES (:inter, :tdwId, :usrId)";
     $ddlStatement = $dbConnection->prepare($sql);

     $ddlStatement->bindParam(":inter", $intType);
     $ddlStatement->bindParam(":tdwId", $tweet_id);
     $ddlStatement->bindParam(":usrId", $user_id);

     $ddlStatement->execute();

    echo "Like added successfully!";
}

// Display the post content
echo '<div class="post">';
echo '<p>' . $post['content'] . '</p>';

// Like button
echo '<form method="post">';
echo '<input type="hidden" name="post_id" value="' . $post['post_id'] . '">';
echo '<button type="submit" name="like">Like</button>';
echo '</form>';
echo '</div>';
