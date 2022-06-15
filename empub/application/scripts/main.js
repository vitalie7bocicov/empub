import {appendEmails} from './utils.js';
window.onload = () => {
    filterBy();
    orderBy();
    search();
    appendEmails();
}

function search(){
    document.getElementById('search').addEventListener('submit', (event) => {
        event.preventDefault();
        appendEmails();
    });
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
