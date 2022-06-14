import {Mail} from "./Mail.js";

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
        spanDate.innerText = `${publicationDate.getDate()}/${publicationDate.getMonth().toString().padStart(2,"0")}/${publicationDate.getFullYear()}`;
    }
    else if(orderBy ==="expiration_date"){
        let expirationDate = new Date(mail.expirationDate);
        spanDate.innerText = `${expirationDate.getDate()}/${expirationDate.getMonth().toString().padStart(2,"0")}/${expirationDate.getFullYear()}`;
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
    // emailText.innerText = mail.message;
    emailMessage.appendChild(emailSubject);
    emailMessage.appendChild(emailText);

    emailContent.appendChild(emailSender);
    emailContent.appendChild(emailMessage);

    const emailLock = document.createElement('a');

    const emailSettings = document.createElement('a');
    const emailStats = document.createElement('a');
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

    emailSettings.appendChild(material_icons_span2);
    emailSettings.classList.add('email-settings');
    emailSettings.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        localStorage.setItem('mailId', event.target.parentElement.parentElement.parentElement.id);
        location.href="http://localhost/TehnologiiWeb/empub/public/emailSettings";
    });


    emailStats.appendChild(material_icons_span3);
    emailStats.appendChild(emailViews);
    emailStats.classList.add('email-stats');


    emailDelete.appendChild(material_icons_span4);
    emailDelete.classList.add('email-delete');
    emailDelete.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        deleteEmail(event.target.parentElement.parentElement.parentElement);
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



function deleteEmail(mail) {
    //delete mail from dom
    mail.remove();

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
                throw new TypeError(`Response with code ${response.status}`);
            }
        })
}

function getOrderBy(){//publication_date or expiration_date or views
    const orderBy = document.getElementById('order-by');
     return  orderBy.options[orderBy.selectedIndex].value;
}

function getFilter(){//all or public or private
    const filter = document.getElementById('email-permission');
    return filter.options[filter.selectedIndex].value;
}

function appendEmails()
{
    let orderBy = getOrderBy();
    let filter = getFilter();
    let emailList = document.getElementById('email-list');
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    myHeaders.append('filter', filter);
    myHeaders.append('orderBy', orderBy);
    let request = new Request(`http://localhost/TehnologiiWeb/emails/mail`, {
        method: 'GET',
        headers: myHeaders
    });
    fetch(request)
        .then(res => {
            if(res.status != 200) {
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
            for(let i = 0; i < length; i++) {
                let mail = new Mail(data[i]);
                const elem = appendEmail(mail);
                emailList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
}

export {appendEmail, appendEmails};