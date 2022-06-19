import {Mail} from "./Mail.js";
import {deleteEmail} from './utils.js';
window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });

    const inboxButton = document.getElementById('inboxButton');
    inboxButton.addEventListener('click', () => {
        const admin = localStorage.getItem('nimda');
        
        if(admin) {
            getMailUser(cookies['mailID']);
        }
        else {
            location.href = 'http://localhost/TehnologiiWeb/empub/public/main';
        }
    });

    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getEmailById = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailByID/${cookies['mailID']}`, {
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
const date = document.getElementById('dateOfExpiration');
const time = document.getElementById('timeofExpiration');
const passwordInput = document.getElementById('passwordInput');
const passwordLabel = document.getElementById('passwordLabel');
let mailIsPublic;

function linkStatsButton(mail){
    const statsButton = document.getElementById("stats");
    statsButton.addEventListener("click",((event) => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/statistics/${mail.id}`;
    }));
}

function setInfo(mail) {

    linkStatsButton(mail);
    mailIsPublic = mail.isPublic;
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
        passwordLabel.innerText="Change password:";
    }


    const expirationDate = new Date(mail.expirationDate);
    date.value=formatDate(expirationDate);
    date.min = new Date().toLocaleDateString('en-ca');


    time.value=formatTime(expirationDate);
    onFormSubmit(mail);
}

function getMailUser(id) {
    
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
        let myHeaders = new Headers();
        myHeaders.append('Authorization', authToken);
        let getEmailUser = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailUser/${id}`, {
                method: 'GET',
                headers: myHeaders
        });

        fetch(getEmailUser)
        .then((respose) => {
            if(respose.status != 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = respose.headers.get('Content-Type');
    
            if(contentType && contentType.includes('application/json')) {
                //location.href = './home';
                return respose.json();
            }
    
            throw new TypeError (`Not Json`);
        })
        .then(data => {
           if(data !== null) {
                location.href = `http://localhost/TehnologiiWeb/empub/public/main/${data.user}`;
           }
        })
    .catch(err => {
        console.log(err);
    });
}

function onFormSubmit(mail) {
    const formSubmit = document.getElementById('form');

    formSubmit.addEventListener('submit', (e) => {

        e.preventDefault();


        if(passwordInput.value.length<5 && getSelectedOption()==="private"){
            message.innerText = "Password must be at least 5 characters long!"
            message.classList.add('showMessage');
            return;
        }

        updateSettings(mail);

    });
}

function handleClick(option) {
    message.classList.remove('showMessage');
    if (currentRadio != null) {//toggle option
        currentRadio.classList.remove('changeOpacity');
        if (passwordButton != null){
            passwordButton.classList.remove('displayBlock');

        }

    }
    if(mailIsPublic === 1){
        passwordLabel.innerText="Set password:";
    }else{
        passwordLabel.innerText="Change password:";
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

function updateSettings(mail){

    const newExpirationDate = date.value+ " " + time.value +":00";
    const isPublic = getSelectedOption()==="public"?1:0;
    mailIsPublic=isPublic;
    const newPassword = isPublic===0?passwordInput.value:"NULL";
    if(isPublic===0){
        passwordLabel.innerText="Change password:";
        passwordInput.value="";
    }


    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    myHeaders.append("expirationdate", newExpirationDate);
    myHeaders.append("ispublic", isPublic);
    myHeaders.append("password", newPassword);
    let updateMailById = new Request(`http://localhost/TehnologiiWeb/emails/mail/updateMailByID/${mail.id}`, {
        method: 'PUT',
        headers: myHeaders
    });
    fetch(updateMailById)
        .then((response) => {
            if(response.status !== 200) {
                throw new TypeError(`Response with code ${response.status}`);
            }
            message.innerText = "Settings successfully updated!"
            message.classList.add('showMessage');

        })
        .catch(err => {
            console.log(err);
        });

}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth()+1),
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

function getSelectedOption(){
    if(document.getElementById('check1').classList.contains('changeOpacity'))
        return "public";
    return "private";
}


