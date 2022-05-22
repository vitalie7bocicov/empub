window.onload = () => {
    console.log("form submited");
    // const formSubmit = document.getElementById('formSubmit');

    // formSubmit.addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     const email = document.getElementById('email').value;
    //
    //     let request = new Request(`./login/verifyEmail/${email}`, {
    //         method: 'GET',
    //         headers: {}
    //     });
    //
    //
    //     fetch(request)
    //     .then((response) => {
    //         if(response.status != 200) {
    //             throw new TypeError (`Response with code ${response.status}`);
    //         }
    //         const contentType = response.headers.get('Content-Type');
    //
    //         if(contentType && contentType.includes('application/json')) {
    //             return response.json();
    //         }
    //
    //         throw new TypeError (`Not Json`);
    //     })
    //     .then(data => {
    //         if(data.response !== false) {
    //             formSubmit.submit();
    //             return;
    //         }
    //
    //         const errMessage = document.getElementById('errMessage');
    //         errMessage.classList.add('err');
    //     })
    //     .catch(err => {
    //
    //     });
    // });
}

