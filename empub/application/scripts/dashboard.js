import {appendUsers} from './dashboardUtils.js';

window.onload = () => {
    appendUsers();
    search();

var modal = document.getElementById("myModal");
    

var btn = document.getElementById("btn");


var span = document.getElementsByClassName("close")[0];
    
var csv = document.getElementById("csv");

csv.addEventListener('click', ()=>{
    const authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let request = new Request(`http://localhost/TehnologiiWeb/users/users`, {
        method: 'GET',
        headers: myHeaders
    });
    fetch(request)
        .then(res => {
            if(res.status != 200) {
                checkStatus(res.status);
                throw new TypeError (`Response with code ${res.status}`);
            }
            const contentType = res.headers.get('Content-Type');
            if(contentType && contentType.includes('application/json')) {
                return res.json();
            }
            throw new TypeError ('Response got is not in correct format');
        })
        .then(data => {
                 console.log(data);
                let csvContent = "data:text/csv;charset=utf-8,";

                data.forEach(function(rowArray) {
                    let row = Object.values(rowArray).join(",");
                    csvContent += row + "\r\n";
                });

                var encodedUri = encodeURI(csvContent);
                window.open(encodedUri);
            
        })
        .catch(err => {
            console.log(err);
        });
});    


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
