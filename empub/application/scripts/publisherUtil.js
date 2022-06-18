import {Mail} from "./Mail.js";
import {constructEmailVisitorView} from './emailField.js';
let mailsArray = [];
let currentMail;

window.onload = () => {
    appendEmails();

    const insert_password = document.getElementById('insert-password');
    
    insert_password.addEventListener('submit', (event) => {
        event.preventDefault();
        const password = document.getElementById('password');


        
    });
};

function appendEmails() {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });
    const userId = cookies['userId'];

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

    let request = new Request(`http://localhost/TehnologiiWeb/emails/mail/${userId}`, {
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
            deleteAllEmails();
            mailsArray = data;

            for(let i = 0; i < length; i++) {
                let mail = new Mail(data[i]);
                const elem = constructEmailVisitorView(mail);

                console.log(elem);
                elem.addEventListener('click', clickEventHandler);
                //     updateLastMailId(mail);
                //     const elem = appendEmail(mail);
                emailList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
}

function clickEventHandler(event) {
    const target = event.currentTarget;
    const id = target.getAttribute('id');

    const length = mailsArray.length;
    let mail;
    for(let i = 0; i < length; i++) {
        if(id == mailsArray[i].id) {
            mail = mailsArray[i];
        }
    }


    currentMail = mail;
    var password = document.getElementById('insert-password');
    var overlay = document.getElementById('overlay');
    if(mail.isPublic === 0) {
        overlay.classList.add('displaNone');
        password.classList.add('insert-password-display');

        const passwordForm = document.getElementById('insert-password');
        passwordForm.addEventListener('submit', (event) => {
            const passwordInput = document.getElementById('password');
            const password = passwordInput.value;

            fetchEmail(password, id);
        });
    }
    else {
        overlay.classList.remove('displaNone');
        password.classList.remove('insert-password-display');

        fetchEmail('', id);
    }

    
}

function fetchEmail(password, id) {
    let aux;
    if(password !== '') {
        aux = `{ "password" : "${password}" }`;
    }
    const incorectPass = document.getElementById('incorectPass');
    incorectPass.classList.remove('displayIncoretPassword');

    const authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);

    let request = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailContentByIDWithPassword/${id}`, {
        method: 'POST',
        headers: myHeaders,
        body: aux
    });

    fetch(
        new Request(`http://localhost/TehnologiiWeb/statistics/statistics/updateStatisticsForMail/${id}`,
        {method:'GET', headers:myHeaders})
        )
    .then((response) => {
            if(response.status != 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = response.headers.get('Content-Type');
    
            if(contentType && contentType.includes('application/json')) {
                //location.href = './home';
                return response.json();
            }
            
            throw new TypeError (`Not Json`);
    })
    .catch(err => {
            console.log(err);
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
        if(data == null) {
            incorectPass.classList.add('displayIncoretPassword');
            return null;
        }

        let password = document.getElementById('insert-password');
        let overlay = document.getElementById('overlay');
        const passwordInput = document.getElementById('password');
        overlay.classList.remove('displaNone');
        password.classList.remove('insert-password-display');
        passwordInput.value = '';

        const html = data.htmlText;
        const iframeElem = document.getElementById('email-frame');
        
        const childDocument = iframeElem.contentDocument;

        const style = document.createElement('style');
        style.innerText = 'table{ width: 100%; font-width: 14px; }';
        const parser = new DOMParser();
        const parsedDocument = parser.parseFromString(html, 'text/html');
        
        console.log(parsedDocument);
        const head = parsedDocument.getElementsByTagName('head')[0];
        
        head.appendChild(style);
        const child = parsedDocument.documentElement;
        childDocument.replaceChild(child, childDocument.documentElement);
    });

}

function deleteAllEmails(){
    const emailList = document.getElementById('email-list');
    emailList.replaceChildren();
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