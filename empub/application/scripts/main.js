import {appendEmails, checkNewEmails} from './utils.js';

window.onload = () => {
    filterBy();
    orderBy();
    search();
    appendEmails();
    checkNewEmail();
}

function search(){
    document.getElementById('search').addEventListener('submit', (event) => {
        event.preventDefault();
        appendEmails();
    });
}

function checkNewEmail(){
    checkNewEmails();
    setTimeout(checkNewEmail, 1000);
}

function orderBy(){
    document.getElementById('order-by').addEventListener('change', (event) => {
        appendEmails();
    });
}

function filterBy(){
    document.getElementById('email-permission').addEventListener('change', (event) => {
        appendEmails();
    });
}


