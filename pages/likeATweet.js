document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll("[id^='like-button']")
    .forEach(function (likeButton) {
      likeButton.addEventListener("click", function () {
        let tweetId = likeButton.closest(".feed-post").dataset.tweet_id;
        let isLiked = likeButton.src.endsWith("filledHeart.svg");

        // console.log("Tweet ID:", tweetId);
        // console.log("Is Liked:", isLiked);

        fetch("../controllers/like.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            like: !isLiked, // Toggle like status
            tweet_id: tweetId,
          }),
        })
          .then((response) => {
            if (response.ok) {
              // console.log("Response is ok....");
              return response.json();
            }
            throw new Error("Network response was not ok");
          })
          .then((data) => {
            console.log("Response from Server:", data);

            likeButton.src = data.isLiked
              ? `images/filledHeart.svg?v=${Date.now()}`
              : `images/like.svg?v=${Date.now()}`;
            console.log("Source of the image: ", likeButton.src);
            console.log("Data if he has liked or not", data.hasLiked);
            console.log("data data ddata", data.isLiked);
          })
          .catch((error) => {
            console.error("There was a problem in fetching for a like.", error);
          });
      });
    });
});
