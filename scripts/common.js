const hambButton = document.querySelector('.hamburger');
const mobileMenu = document.querySelector('.header__mobile-menu');

hambButton.addEventListener('click', () => {
  hambButton.classList.toggle('is-active');
  mobileMenu.classList.toggle('header__mobile-menu--visible');
});