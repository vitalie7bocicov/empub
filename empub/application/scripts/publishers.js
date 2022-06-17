import {appendPublishers} from './visitorUtils.js';

window.onload = () => {
    appendPublishers();
    search();
}

function search(){
    document.getElementById('search').addEventListener('submit', (event) => {
        event.preventDefault();
        appendPublishers();
    });
}
