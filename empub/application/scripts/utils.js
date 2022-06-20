import {Mail} from "./Mail.js";

let lastMailId = -1;

function appendEmail(mail) {
    const emailRow = document.createElement('div');
    emailRow.classList.add('email-row');

    emailRow.setAttribute('id', mail.id);
    emailRow.addEventListener('click', () => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/email/${mail.id}`;
    });

    const emailDate = document.createElement('div');
    emailDate.classList.add('email-date');
    const spanDate = document.createElement('span');
    spanDate.classList.add('email-expiration-date');

    const orderBy = getOrderBy();

    if(orderBy === "publication_date" || orderBy==="views"){
        let publicationDate = new Date(mail.publicationDate);
        spanDate.innerText = `${publicationDate.getDate().toString().padStart(2,"0")}/${(publicationDate.getMonth() +1).toString().padStart(2,"0")}/${publicationDate.getFullYear()}`;
    }
    else if(orderBy ==="expiration_date"){
        let expirationDate = new Date(mail.expirationDate);
        spanDate.innerText = `${expirationDate.getDate().toString().padStart(2,"0")}/${(expirationDate.getMonth()+1).toString().padStart(2,"0")}/${expirationDate.getFullYear()}`;
    }

    emailDate.appendChild(spanDate);
    
    const emailContent = document.createElement('div');
    emailContent.classList.add('email-content');

    const emailSender = document.createElement('div');
    emailSender.classList.add('email-sender');
    const emailSenderTitle = document.createElement('h3');
    emailSenderTitle.innerText = mail.sender;
    emailSender.appendChild(emailSenderTitle);

    const emailMessage = document.createElement('div');
    emailMessage.classList.add('email-message');
    const emailSubject = document.createElement('span');
    const emailText = document.createElement('span');

    emailText.classList.add('email-text');
    emailSubject.classList.add('email-subject');
    emailSubject.innerText = mail.subject;
    emailMessage.appendChild(emailSubject);
    emailMessage.appendChild(emailText);

    emailContent.appendChild(emailSender);
    emailContent.appendChild(emailMessage);

    const emailLock = document.createElement('a');

    const emailSettings = document.createElement('a');
    const emailStats = document.createElement('a');
    emailStats.href = `http://localhost/TehnologiiWeb/empub/public/statistics/${mail.id}`;
    const emailDelete = document.createElement('a');

    const emailOptions = document.createElement('div');
    emailOptions.classList.add('email-options');

    const material_icons_span1 = document.createElement('span');
    const material_icons_span2 = document.createElement('span');
    const material_icons_span3 = document.createElement('span');
    const material_icons_span4 = document.createElement('span');
    const emailViews = document.createElement('span');
    emailViews.classList.add('email-views');
    emailViews.textContent=mail.views;
    material_icons_span1.classList.add('material-icons');

    if(mail.isPublic===1){
        material_icons_span1.classList.add('email-unlocked');
        material_icons_span1.textContent = 'lock_open';
    }
    else{
        material_icons_span1.classList.add('email-locked');
        material_icons_span1.textContent = 'lock';
    }
    material_icons_span2.classList.add('material-icons');
    material_icons_span3.classList.add('material-icons');
    material_icons_span4.classList.add('material-icons');

    material_icons_span2.textContent = 'settings';
    material_icons_span3.textContent = 'query_stats';
    material_icons_span4.textContent = 'delete';

    emailLock.appendChild(material_icons_span1);

    emailLock.classList.add('email-lock');
    emailLock.title = "Locked";
    emailLock.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        // localStorage.setItem('mailId', event.target.parentElement.parentElement.parentElement.id);
        location.href=`http://localhost/TehnologiiWeb/empub/public/emailSettings/${mail.id}`;
    });

    emailSettings.appendChild(material_icons_span2);
    emailSettings.classList.add('email-settings');
    emailSettings.title='Settings';
    emailSettings.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        // localStorage.setItem('mailId', event.target.parentElement.parentElement.parentElement.id);
        location.href=`http://localhost/TehnologiiWeb/empub/public/emailSettings/${mail.id}`;
    });


    emailStats.appendChild(material_icons_span3);
    emailStats.appendChild(emailViews);
    emailStats.classList.add('email-stats');
    emailStats.title='Statistics';


    emailDelete.appendChild(material_icons_span4);
    emailDelete.classList.add('email-delete');
    emailDelete.title='Delete';
    emailDelete.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        deleteEmailFromList(event.target.parentElement.parentElement.parentElement);
    });

    emailOptions.appendChild(emailLock);
    emailOptions.appendChild(emailSettings);
    emailOptions.appendChild(emailStats);
    emailOptions.appendChild(emailDelete);


    emailRow.appendChild(emailDate);
    emailRow.appendChild(emailContent);
    emailRow.appendChild(emailOptions);

    return emailRow;
}

function deleteEmailRequest(mail){
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let deleteEmail = new Request(`http://localhost/TehnologiiWeb/emails/mail/deleteMailByID/${mail.id}`, {
        method: 'DELETE',
        headers: myHeaders
    });

    fetch(deleteEmail)
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

function deleteEmailFromList(mail) {
    //delete mail from dom
    mail.remove();
    deleteEmailRequest(mail);
}

function deleteEmail(mail) {
    deleteEmailRequest(mail);
}

function parseJwt (token) {
    const base64Url = token.split('.')[1];

    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};

function appendEmails()     {
    let cookies = {};
    let id = '';

    const userObj = parseJwt(localStorage.getItem('accessToken')).data;
     if(document.cookie !== '') {
        document.cookie.split(';').forEach(element => {
            let [key, value] = element.split('=');
            cookies[key.trim()] = value.trim();
        });

        id = cookies['userId'];
    }

    const admin = localStorage.getItem('nimda');
    if(admin === null && id !== '') {
        id = '';
    }

    const orderBy = getOrderBy();
    const filter = getFilter();
    const query = getQuery();
    const emailList = document.getElementById('email-list');
    const authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    myHeaders.append('filter', filter);
    myHeaders.append('orderBy', orderBy);
    myHeaders.append('searchquery', query);
    let request = new Request(`http://localhost/TehnologiiWeb/emails/mail/${id}`, {
        method: 'GET',
        headers: myHeaders
    });
    fetch(request)
        .then(res => {
            if(res.status != 200) {
                checkStatus(res.status);
                throw new TypeError (`Response with code ${res.status}`);
            }
            // console.log(res.text());
            const contentType = res.headers.get('Content-Type');
            if(contentType && contentType.includes('application/json')) {
                return res.json();
            }
            throw new TypeError ('Response got is not in correct format');
        })
        .then(data => {
            let length = data.length;
            deleteAllEmails();//from dom
            for(let i = 0; i < length; i++) {
                let mail = new Mail(data[i]);
                 updateLastMailId(mail);
                const elem = appendEmail(mail);
                emailList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
}

function updateLastMailId(mail){
    if(lastMailId<mail.id)
        lastMailId = mail.id;
}

function getLastMailId(){
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getLastMailId = new Request(`http://localhost/TehnologiiWeb/emails/mail/getLastMailId`, {
        method: 'GET',
        headers: myHeaders
    });
    fetch(getLastMailId)
        .then((response) => {
            if(response.status !== 200) {
                checkStatus(response.status);
                throw new TypeError(`Response with code ${response.status}`);
            }
            return response.json();
        })
        .then((id) =>{
            compareLastMailsIDs(id);
        })
        .catch(err => {
            console.log(err);
        });
}

function compareLastMailsIDs(newId){
    if(newId>lastMailId){
        appendEmails();
    }
}

function checkNewEmails(){
    getLastMailId();
}

function checkStatus(code){
    if(code==403)
        location.href="http://localhost/TehnologiiWeb/empub/public/";
}

function getOrderBy(){//publication_date or expiration_date or views
    const orderBy = document.getElementById('order-by');
    return  orderBy.options[orderBy.selectedIndex].value;
}

function getFilter(){//all or public or private
    const filter = document.getElementById('email-permission');
    return filter.options[filter.selectedIndex].value;
}

function getQuery(){
    const query = document.getElementById('search-input');
    return query.value;
}

function deleteAllEmails(){//from dom
    const allEmails = document.getElementById('email-list');
    allEmails.replaceChildren();
}

export {appendEmail, appendEmails, deleteEmail, deleteAllEmails, checkNewEmails, getOrderBy,getFilter,getQuery};