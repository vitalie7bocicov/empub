window.onload = () => {
    const formSubmit = document.getElementById('formSubmit');

    formSubmit.addEventListener('submit',  (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        checkIfAdmin(email, formSubmit);
     });
}

function checkIfAdmin(email, formSubmit){
    let request = new Request(`http://localhost/TehnologiiWeb/login/public/login/verifyAdmin/${email}`, {
        method: 'GET',
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
            
            if(data.response !== false) {
                localStorage.setItem("nimda", true);
                formSubmit.submit();
                return;
            }

            verifyUser(email, formSubmit);
        })
        .catch(err => {
            console.log(err);
        });
}

function verifyUser(email, formSubmit) {
    let request = new Request(`http://localhost/TehnologiiWeb/login/public/login/verifyEmail/${email}`, {
            method: 'GET',
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

            if(data.response !== false) {
                formSubmit.submit();
                return;
            }
            
        })
        .catch(err => {
            console.log(err);
        });
}