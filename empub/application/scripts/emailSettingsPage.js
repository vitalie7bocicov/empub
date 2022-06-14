import {Mail} from "./Mail.js";

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
            if(response.status != 200) {
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
            console.log(mail);
        });

}

let currentRadio = null;
let doc;

function handleClick(myRadio) {

    if (currentRadio != null) {
        currentRadio.classList.remove('changeOpacity');
        if (doc != null)
            doc.classList.remove('displayBlock');
    }
    if (myRadio.value == 1) {
        let i1 = document.getElementById('check1');
        i1.classList.add('changeOpacity');
        currentRadio = i1;
    }
    else if (myRadio.value == 2) {
        let i2 = document.getElementById('check2');
        i2.classList.add('changeOpacity');
        currentRadio = i2;
    }
    else {
        let i3 = document.getElementById('check3');
        i3.classList.add('changeOpacity');
        currentRadio = i3;
        doc = document.getElementById('password');
        doc.classList.add('displayBlock');
    }
}