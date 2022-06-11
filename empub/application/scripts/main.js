import {Mail} from './Mail.js';
import {appenEmail} from './uiUtil.js';

window.onload = () => {
    let emailList = document.getElementById('email-list');


    
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
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
            const elem = appenEmail(mail);
            emailList.appendChild(elem);    
        }
    })
    .catch(err => {
        console.log(err);
    });
}