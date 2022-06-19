import {Publisher} from "./Publisher.js";

function appendUser(publisher) {
    const publisherRow = document.createElement('div');
    publisherRow.classList.add('publisher-row');

    publisherRow.setAttribute('id', publisher.email);
    publisherRow.addEventListener('click', () => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/main/${publisher.id}`;
    });


    const publisherEmail = document.createElement('div');
    publisherEmail.classList.add('publisher-email');

    const publisherEmailTitle = document.createElement('h3');
    publisherEmailTitle.innerText = publisher.email;
    publisherEmail.appendChild(publisherEmailTitle);

    publisherRow.appendChild(publisherEmail);

    const publisherInfo = document.createElement('div');
    publisherInfo.classList.add('publisher-info');

    const publisherName = document.createElement('div');
    publisherName.classList.add('publisher-name');
    const publisherFirstName = document.createElement('span');
    const publisherLastName = document.createElement('span');


    publisherFirstName.classList.add('publisher-first-name');
    publisherLastName.classList.add('publisher-last-name');

    publisherFirstName.innerText = publisher.first_name;
    publisherLastName.innerText = publisher.last_name;

    publisherName.appendChild(publisherFirstName);
    publisherName.appendChild(publisherLastName);

    publisherRow.appendChild(publisherEmail);
    publisherInfo.appendChild(publisherName);

    publisherRow.appendChild(publisherInfo);
    const options = document.createElement('div');
    options.classList.add("delete");

    const userDelete = document.createElement('a');
    const material_icons_span4 = document.createElement('span');
    material_icons_span4.classList.add('material-icons');
    material_icons_span4.textContent = 'delete';
    userDelete.appendChild(material_icons_span4);
    userDelete.classList.add('email-delete');
    userDelete.title='Delete';
    userDelete.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        deleteUserFromList(event.target.parentElement.parentElement.parentElement);
        deleteUserRequest(publisher);
    });
    options.appendChild(userDelete);

    publisherRow.append(options);

    return publisherRow;
}


function appendUsers(){
    const query = getQuery();
    const publisherList = document.getElementById('publishers-list');
    const authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    myHeaders.append('searchquery', query);
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
            let length = data.length;
            deleteAllPublishers();//from dom
            for(let i = 0; i < length; i++) {
                let user = new Publisher(data[i]);
                const elem = appendUser(user);
                publisherList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
}

function deleteUserRequest(user){
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let deleteUser = new Request(`http://localhost/TehnologiiWeb/users/users/deleteUser/${user.id}`, {
        method: 'POST',
        headers: myHeaders
    });
    fetch(deleteUser)
        .then((response) => {
            if(response.status !== 200) {
                checkStatus(response.status);
                throw new TypeError(`Response with code ${response.status}`);
            }
            appendUsers();
        })
        .catch(err => {
            console.log(err);
        });
}

function deleteUserFromList(user) {
    //delete mail from dom
    user.remove();
}

function deleteAllPublishers(){//from dom
    const allPublishers = document.getElementById('publishers-list');
    allPublishers.replaceChildren();
}

function checkStatus(code){
    if(code==403)
        location.href="http://localhost/TehnologiiWeb/empub/public/";
}
function getQuery(){
    const query = document.getElementById('search-input');
    return query.value;
}



export {appendUsers};