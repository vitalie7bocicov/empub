window.onload = () => {
    const formSubmit = document.getElementById('formSubmit');

    formSubmit.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;

        let request = new Request(`./login/verifyEmail/${email}`, {
            method: 'GET',
            headers: {}
        });


        fetch(request)
        .then((respose) => {
            if(respose.status != 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = respose.headers.get('Content-Type');
            
            if(contentType && contentType.includes('application/json')) {
                return respose.json();
            }

            throw new TypeError (`Not Json`);
        })
        .then(data => {
            if(data.respose !== false) {
                formSubmit.submit();
                return;
            }

            const errMessage = document.getElementById('errMessage');
            errMessage.classList.add('err');
        })
        .catch(err => {
            
        });
    });
}

