
//window.onload = () => {
  const homeButton = document.getElementById('homeButton');
  const admin = localStorage.getItem('nimda');

  if(admin) {
    homeButton.setAttribute('href', 'http://localhost/TehnologiiWeb/empub/public/dashboard');
  }

//}
const logout = document.getElementById('logout');

logout.addEventListener('click', () => {
  localStorage.removeItem('accessToken');
  localStorage.removeItem('nimda');
})
const hamburgerButton = document.getElementsByClassName("hamburger")[0];
const navLinks = document.getElementsByClassName("nav-links")[0];

hamburgerButton.addEventListener("click", () => {
  hamburgerButton.classList.toggle("open");
  navLinks.classList.toggle('active');
});
