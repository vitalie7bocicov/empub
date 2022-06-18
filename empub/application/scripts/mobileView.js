window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });

    const id = cookies['mailID'];
    
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let request = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailByID/${id}`, {
        method: 'GET',
        headers: myHeaders
    });


    fetch(request)
    .then(response =>  {
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
    .then(data => {
        const public = data.isPublic;
        const overlay = document.getElementById('overlay');
        const insertPassword = document.getElementById('insert-password');

        if(public === 0) {
            overlay.classList.add('displayBlock');
            insertPassword.classList.add('insert-password-display');
        
            insertPassword.addEventListener('submit', (event) => {
                event.preventDefault();
                const passwordInput = document.getElementById('password');
                const password = passwordInput.value;

                fetchEmail(password, id);
            });
        }
        else
            fetchEmail('', id);
    });


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
            overlay.classList.remove('displayBlock');
            password.classList.remove('insert-password-display');
            passwordInput.value = '';
    
            const html = data.htmlText;
            const iframeElem = document.getElementById('email-frame');
            
            const childDocument = iframeElem.contentDocument;
    
            const style = document.createElement('style');
            style.innerText = 'table{ width: 100%; } @media screen and (max-width: 850px) { font-size: 14px; }';
            const parser = new DOMParser();
            const parsedDocument = parser.parseFromString(html, 'text/html');
            
            console.log(parsedDocument);
            const head = parsedDocument.getElementsByTagName('head')[0];
            
            head.appendChild(style);
            const child = parsedDocument.documentElement;
            childDocument.replaceChild(child, childDocument.documentElement);
        });
    
    }
}