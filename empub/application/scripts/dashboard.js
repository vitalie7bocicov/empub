import {appendUsers} from './dashboardUtils.js';

window.onload = () => {
    appendUsers();
    search();

var modal = document.getElementById("myModal");
    

var btn = document.getElementById("btn");


var span = document.getElementsByClassName("close")[0];


btn.onclick = function() {
  modal.style.display = "block";
}


span.onclick = function() {
  modal.style.display = "none";
}

const create = document.getElementById('create');

create.addEventListener('click', ()=>{
 
  const email = document.getElementById('email').value;
  const fname = document.getElementById('fname').value;
  const lname = document.getElementById('lname').value;
  var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  if(email.match(validRegex)){

  let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
  let myHeaders = new Headers();
  myHeaders.append('Authorization', authToken);
 
  let createUser = new Request(`http://localhost/TehnologiiWeb/users/users/createUser/${email}/${fname}/${lname}`, {
      method: 'POST',
      headers: myHeaders
  });

  fetch(createUser)
      .then((response) => {
          if(response.status !== 200) {
              checkStatus(response.status);
              throw new TypeError(`Response with code ${response.status}`);
          }
      })
      .catch(err => {
          console.log(err);
      });
    }

});


}

window.onclick = (event) =>{
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
      }
}

function search(){
    document.getElementById('search').addEventListener('submit', (event) => {
        event.preventDefault();
        appendUsers();
    });
}
