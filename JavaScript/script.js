// script.js

function toggleMenu() {
  console.log('Toggle menu function called'); // Agregamos un log para verificar que se llama la función
  var navbar = document.querySelector('.navbar');
  var overlay = document.querySelector('.overlay');

  if (navbar.style.display === 'block' || getComputedStyle(navbar).display === 'block') {
    navbar.style.animation = 'slideOut 0.5s ease-in';
    overlay.style.display = 'none';
    setTimeout(() => {
      navbar.style.display = 'none';
      navbar.style.animation = '';
    }, 500);
  } else {
    navbar.style.display = 'block';
    navbar.style.animation = 'slideIn 0.5s ease-out';
    overlay.style.display = 'block';
  }
}
/*Devoloped by Brandon Ventura*/