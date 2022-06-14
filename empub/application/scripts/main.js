import {appendEmails} from './utils.js';
window.onload = () => {
    filterBy();
    orderBy();
    appendEmails();
}

function deleteAllEmails(){//from dom
    const allEmails = document.getElementById('email-list');
    allEmails.replaceChildren();
}

function orderBy(){
    document.getElementById('order-by').addEventListener('change', (event) => {
        deleteAllEmails();
        appendEmails();
    });
}

function filterBy(){
    document.getElementById('email-permission').addEventListener('change', (event) => {
        deleteAllEmails();
        appendEmails();
    });
}
