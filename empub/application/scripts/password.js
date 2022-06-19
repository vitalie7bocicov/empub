window.onload = () => {
    if(localStorage.getItem('nimda')){
        checkAdminPassword();
        return;
    }

    const hidden = document.getElementById('hidden');
    const obj = `{ "email": "${hidden.value}" }`;
   

    let request = new Request(`http://localhost/TehnologiiWeb/login/public/login/generatePasswordandSendEmail`, {
        method: 'POST',
        body: obj,
        headers: {}
    });
    
    const submitForm = document.getElementById('submitForm');
    
    submitForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const hidden = document.getElementById('hidden');
        const passInput = document.getElementById('password');
        const email = hidden.value;
        const password = passInput.value;
        localStorage.setItem("email",email);
    
        const aux = `{ "email": "${email}",
                        "password": "${password}" }`;
    
        let requestToVerifyPassword = new Request(`http://localhost/TehnologiiWeb/login/public/login/verifyPassword`, {
            method: 'POST',
            body: aux,
            headers: {}
        });
    
        fetch(requestToVerifyPassword)
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
        .then(data => {
            if(typeof data.response === 'object') {

                localStorage.setItem('accessToken', data.response.token);
                location.href = 'http://localhost/TehnologiiWeb/empub/public/main';
            }
    
            const text = data.response;
            const errMessage = document.getElementById('errMessage');
            console.log(errMessage);
            errMessage.textContent = text;
            errMessage.classList.add('err');
    
        });
    });
    
    fetch(request)
    .then((response) => {
        if(response.status != 200) {
            throw new TypeError (`Response with code ${response.status}`);
        }
        const contentType = response.headers.get('Content-Type');
    
        if(contentType && contentType.includes('application/json')) {
            return response.json();
        }
    
        throw new TypeError (`Not Json`);
    });
}

function checkAdminPassword(){
    //localStorage.removeItem('nimda');
    const hidden = document.getElementById('hidden');
    const obj = `{ "email": "${hidden.value}" }`;
    const submitForm = document.getElementById('submitForm');

    submitForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const hidden = document.getElementById('hidden');
        const passInput = document.getElementById('password');
        const email = hidden.value;
        const password = passInput.value;
        localStorage.setItem("email",email);

        const aux = `{ "email": "${email}",
                        "password": "${password}" }`;

        let request = new Request(`http://localhost/TehnologiiWeb/login/public/login/verifyAdminPassword`, {
            method: 'POST',
            body: aux,
            headers: {}
        });
        fetch(request)
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
                if(typeof data.response === 'object') {
                    localStorage.setItem('accessToken', data.response.token);

                    location.href = 'http://localhost/TehnologiiWeb/empub/public/dashboard';
                }
                const text = data.response;
                const errMessage = document.getElementById('errMessage');
                errMessage.textContent = text;
                errMessage.classList.add('err');

            });
    });
}