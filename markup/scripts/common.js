const hambButton = document.querySelector('.hamburger');
const mobileMenu = document.querySelector('.header__mobile-menu');
const mobileMenuWrapper = document.querySelector('.mobile-menu-wrapper');

hambButton.addEventListener('click', () => {
  hambButton.classList.toggle('is-active');
  mobileMenu.classList.toggle('header__mobile-menu--visible');
  mobileMenuWrapper.classList.toggle('mobile-menu-wrapper--pos');
});