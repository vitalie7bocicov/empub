import {Publisher} from "./Publisher.js";



function appendPublisher(publisher) {
    const publisherRow = document.createElement('div');
    publisherRow.classList.add('publisher-row');

    publisherRow.setAttribute('id', publisher.id);
    publisherRow.addEventListener('click', () => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/publisher/${publisher.id}`;
    });


    const publisherEmail = document.createElement('div');
    publisherEmail.classList.add('publisher-email');

    const publisherEmailTitle = document.createElement('h3');
    publisherEmailTitle.innerText = publisher.email;
    publisherEmail.appendChild(publisherEmailTitle);

    publisherRow.appendChild(publisherEmail);

    const publisherInfo = document.createElement('div');
    publisherInfo.classList.add('publisher-info');

    const publisherName = document.createElement('div');
    publisherName.classList.add('publisher-name');
    const publisherFirstName = document.createElement('span');
    const publisherLastName = document.createElement('span');


    publisherFirstName.classList.add('publisher-first-name');
    publisherLastName.classList.add('publisher-last-name');

    publisherFirstName.innerText = publisher.first_name;
    publisherLastName.innerText = publisher.last_name;

    publisherName.appendChild(publisherFirstName);
    publisherName.appendChild(publisherLastName);

    publisherRow.appendChild(publisherEmail);
    publisherInfo.appendChild(publisherName);

    publisherRow.appendChild(publisherInfo);
    const nrPublications = document.createElement('div');
    nrPublications.classList.add("nr-publications");
    const spanNrPublications = document.createElement('span');
    spanNrPublications.innerText=`Nr. of publications: ${publisher.nr_publications}`;
    nrPublications.appendChild(spanNrPublications);

    publisherInfo.append(nrPublications);

    return publisherRow;
}


function appendPublishers() {
    const query = getQuery();
    const publisherList = document.getElementById('publishers-list');
    const authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    myHeaders.append('searchquery', query);
    let request = new Request(`http://localhost/TehnologiiWeb/users/users`, {
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
            deleteAllPublishers();//from dom
            for(let i = 0; i < length; i++) {
                let publisher = new Publisher(data[i]);
                const elem = appendPublisher(publisher);
                publisherList.appendChild(elem);
            }
        })
        .catch(err => {
            console.log(err);
        });
}


function deleteAllPublishers(){//from dom
    const allPublishers = document.getElementById('publishers-list');
    allPublishers.replaceChildren();
}

function checkStatus(code){
    if(code==403)
        location.href="http://localhost/TehnologiiWeb/empub/public/";
}
function getQuery(){
    const query = document.getElementById('search-input');
    return query.value;
}



export {appendPublishers};