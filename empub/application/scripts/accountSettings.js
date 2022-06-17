window.onload = () => {

    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    let email = localStorage.getItem('email');
    myHeaders.append('Authorization', authToken);
    let getProperties = new Request(`http://localhost/TehnologiiWeb/users/users/getProperties/${email}`, {
            method: 'GET',
            headers: myHeaders
    });


    fetch(getProperties)
    .then((response) => {
        if(response.status !== 200) {
            throw new TypeError (`Response with code ${response.status}`);
        }
        const contentType = response.headers.get('Content-Type');
        if(contentType && contentType.includes('application/json')) {
            return response.json();
        }
        throw new TypeError (`Not Json`);
    })
    .then(data => {
        const fname = document.getElementById('fname');
        const lname = document.getElementById('lname');
        const email = document.getElementById('email');
        
        fname.value = data.first_name;
        lname.value = data.last_name;
        email.value = data.email;
    });

    const img = document.getElementById('img');
    
    img.addEventListener('click', () =>{
        console.log(img.value.substring(12));
    });

    const save = document.getElementById('saveBtn');

    save.addEventListener('click' , () => {
        const fname = document.getElementById('fname').value;
        const lname = document.getElementById('lname').value;


        let setName = new Request(`http://localhost/TehnologiiWeb/users/users/setFName/${fname}/${email}`, {
            method: 'POST',
            headers: myHeaders
    });

        let setLname = new Request(`http://localhost/TehnologiiWeb/users/users/setLName/${lname}/${email}`, {
            method: 'POST',
            headers: myHeaders
    });

    fetch(setName);
    fetch(setLname);
   
    });

}
