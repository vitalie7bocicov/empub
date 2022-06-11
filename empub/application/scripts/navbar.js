const hamburgerButton = document.getElementsByClassName("hamburger")[0];
const navLinks = document.getElementsByClassName("nav-links")[0];

hamburgerButton.addEventListener("click", () => {
  hamburgerButton.classList.toggle("open");
  navLinks.classList.toggle('active');
});
