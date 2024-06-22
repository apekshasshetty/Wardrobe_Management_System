// List of background images
const backgroundImages = [
    'https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
    'https://images.unsplash.com/photo-1630904989936-da6328c2f92d?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
    // Add more image URLs as needed
  ];

  // Function to change the background image
  function changeBackground() {
    const randomIndex = Math.floor(Math.random() * backgroundImages.length);
    const imageUrl = `url('${backgroundImages[randomIndex]}')`;
    document.body.style.backgroundImage = imageUrl;
  }

  // Change background on page load and every 5 seconds (adjust as needed)
  changeBackground();
  setInterval(changeBackground, 5000);


  