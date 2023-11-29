const sideBarPostBtn = document.querySelector("#sidebar-post-btn");
const tweetTextInput = document.querySelector("#tweet");
const postNewTweetBtn = document.querySelector("#post-new-tweet");
const insertNewImageBtn = document.querySelector(".insert-type-img");
const inputNewImage = document.querySelector("#choose-img");
const insertGifBtn = document.querySelector(".insert-type-gif");
const newTweetForm = document.querySelector("#tweet-input-form");

sideBarPostBtn.addEventListener("click", (e)=>{
    tweetTextInput.focus();
})

insertNewImageBtn.addEventListener("click", () => {
    console.log("dd");
  inputNewImage.click();
  //me shtu imazhin me append ne form
})

const createGif = function(){
    const apiKey = 'mnihXhYwR3bDACI9iJfkg0u9vvd0v3KN';
    const searchTerm = 'messi';
    const apiUrl = `https://api.giphy.com/v1/gifs/search?q=${searchTerm}&api_key=${apiKey}`;
    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        // Process the response data (e.g., extract GIF URLs)
        const gifUrl = data.data[0].images.fixed_height.url;
        // Display the GIF on your website
        const imgElement = document.createElement('img');
        imgElement.src = gifUrl;
        newTweetForm.appendChild(imgElement);
      })
      .catch(error => console.error('Error fetching GIFs:', error));
}

console.log(insertGifBtn);

insertGifBtn.addEventListener("click", () => {
  createGif();
})


function adjustTextareaHeight() {
    tweetTextInput.style.height = 'auto'; // Reset the height to auto to calculate the new height
    tweetTextInput.style.height = (tweetTextInput.scrollHeight) + 'px'; // Set the new height
}

// Get the textarea element

// Add an input event listener to the textarea
tweetTextInput.addEventListener('input', () => {
    adjustTextareaHeight()
});

// Adjust the height initially in case there is predefined content
adjustTextareaHeight();