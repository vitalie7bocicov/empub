window.onload = () => {
    const hidden = document.getElementById('hidden');
    const obj = `{ "email": "${hidden.value}" }`;

    // let request = new Request(`./generatePasswordandSendEmail`, {
    //     method: 'POST',
    //     body: obj,
    //     headers: {}
    // });
    //
    // const submitForm = document.getElementById('submitForm');
    //
    // submitForm.addEventListener('submit', (event) => {
    //     event.preventDefault();
    //     const hidden = document.getElementById('hidden');
    //     const passInput = document.getElementById('password');
    //     const email = hidden.value;
    //     const password = passInput.value;
    //
    //
    //     const aux = `{ "email": "${email}",
    //                     "password": "${password}" }`;
    //
    //     let requestToVerifyPassword = new Request(`./verifyPassword`, {
    //         method: 'POST',
    //         body: aux,
    //         headers: {}
    //     });
    //
    //     fetch(requestToVerifyPassword)
    //     .then((respose) => {
    //         if(respose.status != 200) {
    //             throw new TypeError (`Response with code ${response.status}`);
    //         }
    //         const contentType = respose.headers.get('Content-Type');
    //
    //         if(contentType && contentType.includes('application/json')) {
    //             //location.href = './home';
    //             return respose.json();
    //         }
    //
    //         throw new TypeError (`Not Json`);
    //     })
    //     .then(data => {
    //         if(data.respose == true) {
    //             location.href = './home';
    //         }
    //
    //         const text = data.respose;
    //         const errMessage = document.getElementById('errMessage');
    //         console.log(errMessage);
    //         errMessage.textContent = text;
    //         errMessage.classList.add('err');
    //
    //     })
    // });
    //
    // fetch(request)
    // .then((respose) => {
    //     if(respose.status != 200) {
    //         throw new TypeError (`Response with code ${response.status}`);
    //     }
    //     const contentType = respose.headers.get('Content-Type');
    //
    //     if(contentType && contentType.includes('application/json')) {
    //         return respose.json();
    //     }
    //
    //     throw new TypeError (`Not Json`);
    // });
}