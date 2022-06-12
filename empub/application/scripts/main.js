import {appendAllEmails, appendPermissionEmails} from './utils.js';
window.onload = () => {
    orderByPerm();
    appendAllEmails();

}

function deleteAllEmails()
{
    const allEmails = document.getElementById('email-list');
    allEmails.replaceChildren();
}


function orderByPerm(){
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
