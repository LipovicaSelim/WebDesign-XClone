document.addEventListener("DOMContentLoaded", function () {
  fetch("../controllers/liked_posts.php")
    .then((response) => response.json())
    .then((data) => {
      const likedTweetsIds = data.map((tweet) => tweet.tweet_id);
      likedTweetsIds.forEach((tweetId) => {
        const likeButton = document.getElementById(`like-button-${tweetId}`);
        if (likeButton) {
          likeButton.src = "images/filledHeart.svg";
        }
      });
    })
    .catch((error) => {
      console.error("Error fetching liked posts: ", error);
    });
});
