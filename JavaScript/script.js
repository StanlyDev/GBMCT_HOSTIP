// Toggle menu function
function toggleMenu() {
  const navbar = document.querySelector('.navbar');
  navbar.classList.toggle('active');
}

// Function to show modal options
function showOptions() {
  const modal = document.getElementById('myModal');
  modal.style.display = "block";
}

// Function to close modal options
function closeOptions() {
  const modal = document.getElementById('myModal');
  modal.style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
  const modal = document.getElementById('myModal');
  if (event.target == modal) {
      modal.style.display = "none";
  }
}
