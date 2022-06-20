import {appendEmails, checkNewEmails} from './utils.js';

window.onload = () => {
    filterBy();
    orderBy();
    search();
    appendEmails();
    checkInbox();
}

function search(){
    document.getElementById('search').addEventListener('submit', (event) => {
        event.preventDefault();
        appendEmails();
    });
}

function checkInbox(){
    checkNewEmails();
    //checkInbox every 1 second
    setTimeout(checkInbox, 1000);
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


