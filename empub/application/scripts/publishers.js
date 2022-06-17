import {appendPublishers} from './publisherUtils.js';

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
