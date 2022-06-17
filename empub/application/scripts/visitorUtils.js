import {Publisher} from "./Publisher.js";



function appendPublisher(publisher) {
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
        spanDate.innerText = `${publicationDate.getDate().toString().padStart(2,"0")}/${publicationDate.getMonth().toString().padStart(2,"0")}/${publicationDate.getFullYear()}`;
    }
    else if(orderBy ==="expiration_date"){
        let expirationDate = new Date(mail.expirationDate);
        spanDate.innerText = `${expirationDate.getDate().toString().padStart(2,"0")}/${expirationDate.getMonth().toString().padStart(2,"0")}/${expirationDate.getFullYear()}`;
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
    emailLock.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        // localStorage.setItem('mailId', event.target.parentElement.parentElement.parentElement.id);
        location.href=`http://localhost/TehnologiiWeb/empub/public/emailSettings/${mail.id}`;
    });

    emailSettings.appendChild(material_icons_span2);
    emailSettings.classList.add('email-settings');
    emailSettings.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        // localStorage.setItem('mailId', event.target.parentElement.parentElement.parentElement.id);
        location.href=`http://localhost/TehnologiiWeb/empub/public/emailSettings/${mail.id}`;
    });


    emailStats.appendChild(material_icons_span3);
    emailStats.appendChild(emailViews);
    emailStats.classList.add('email-stats');


    emailDelete.appendChild(material_icons_span4);
    emailDelete.classList.add('email-delete');
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


function appendPublishers() {
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
            if(res.status !== 200) {
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
                let publisher = new Publisher(data[i]);
                const elem = appendPublisher(publisher);
                publisherList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
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



export {appendPublishers};