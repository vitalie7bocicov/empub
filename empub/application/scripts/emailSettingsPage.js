import {Mail} from "./Mail.js";
import {deleteEmail} from './utils.js';
window.onload = () => {

  const mailId = localStorage.getItem('mailId');
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getEmailById = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailByID/${mailId}`, {
        method: 'GET',
        headers: myHeaders
    });
    fetch(getEmailById)
        .then((response) => {
            if(response.status !== 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = response.headers.get('Content-Type');
            if(contentType && contentType.includes('application/json')) {
                return response.json();
            }
            throw new TypeError (`Not Json`);
        })
        .then(data => {
            let mail = new Mail(data);
            setInfo(mail);
        });

}

let currentRadio = null;
let passwordButton;
const message = document.getElementById('message');
function getSelectedOption(){
    if(document.getElementById('check1').classList.contains('changeOpacity'))
        return "public";
    return "private";
}

function setInfo(mail)
{
    const publicButton = document.getElementById("public");
    publicButton.addEventListener("change",((event) => {
        handleClick(event.target);
    }));
    const privateButton = document.getElementById("private");
    privateButton.addEventListener("change",((event) => {
        handleClick(event.target);
    }));

    const deleteButton = document.getElementById('deleteButton');
    deleteButton.addEventListener("click", (event) => {
        deleteEmail(mail);
        location.href='http://localhost/TehnologiiWeb/empub/public/main';
    });



    if(mail.isPublic) {
        let isPublic = document.getElementById('check1');
        isPublic.classList.add('changeOpacity');
        currentRadio = isPublic;
    }
    else{
        let isPrivate = document.getElementById('check2');
        isPrivate.classList.add('changeOpacity');
        currentRadio = isPrivate;
        passwordButton = document.getElementById('password');
        passwordButton.classList.add('displayBlock');
    }

    const date = document.getElementById('dateOfExpiration');
    let expirationDate = new Date(mail.expirationDate);
    date.value=formatDate(expirationDate);
    date.min = new Date().toLocaleDateString('en-ca');

    const time = document.getElementById('timeofExpiration');
    time.value=formatTime(expirationDate);
    onFormSubmit(mail);
}

function onFormSubmit(mail) {
    const formSubmit = document.getElementById('form');

    formSubmit.addEventListener('submit', (e) => {
        e.preventDefault();
        const password = document.getElementById('passwordInput');

        if(password.value.length<5 && getSelectedOption()==="private"){
            message.innerText = "Password must be at least 5 characters long!"
            message.classList.add('showMessage');
            return;
        }
        message.innerText = "Settings update was successful!"
        message.classList.add('showMessage');

        if(getSelectedOption()==="private")
            password.value="";
        updateSettings(mail);

    });
}

function updateSettings(mail){

}



function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth()),
            padTo2Digits(date.getDate()),
        ].join('-')
    );
}

function formatTime(date) {
    return (
        [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
        ].join(':')
    );
}

function handleClick(option) {
    message.classList.remove('showMessage');
    if (currentRadio != null) {//toggle option
        currentRadio.classList.remove('changeOpacity');
        if (passwordButton != null)
            passwordButton.classList.remove('displayBlock');
    }
    if (option.value == 1) {//isPublic
        const isPublic = document.getElementById('check1');
        isPublic.classList.add('changeOpacity');
        currentRadio = isPublic;
    }
    else {
        const isPrivate = document.getElementById('check2');
        isPrivate.classList.add('changeOpacity');
        currentRadio = isPrivate;
        passwordButton = document.getElementById('password');
        passwordButton.classList.add('displayBlock');
    }
}