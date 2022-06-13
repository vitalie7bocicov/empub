import {appendAllEmails, appendPermissionEmails, getFilter} from './utils.js';
window.onload = () => {
    filterByPerm();
    orderBy();
    appendAllEmails();

}

function deleteAllEmails(){//from dom

    const allEmails = document.getElementById('email-list');
    allEmails.replaceChildren();
}

function orderBy(){
    document.getElementById('order-by').addEventListener('change', (event) => {
        deleteAllEmails();
        let perm = getFilter();
        if (perm === "all") {
            appendAllEmails();
        } else {
            appendPermissionEmails(perm);
        }

    });
}

function filterByPerm(){
    document.getElementById('email-permission').addEventListener('change', (event) => {
        deleteAllEmails();
        switch (event.target.value) {
            case 'all':
                appendAllEmails();
                break;
            case 'public':
                appendPermissionEmails(true);
                break;
            case 'private':
                appendPermissionEmails(false);
                break;
            default:
               break;
        }
    });
}
