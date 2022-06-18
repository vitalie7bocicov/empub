

function constructEmailVisitorView(mail) {
    const emailRow = document.createElement('div');
    emailRow.classList.add('email-row');
    emailRow.setAttribute('id', mail.id);

    const emailDate = document.createElement('div');
    emailDate.classList.add('email-date');

    const emailSpan = document.createElement('span');
    emailSpan.classList.add('email-expiration-date');
    
    let publicationDate = new Date(mail.publicationDate);
    emailSpan.innerText = `${publicationDate.getDate().toString().padStart(2,"0")}/${publicationDate.getMonth().toString().padStart(2,"0")}/${publicationDate.getFullYear()}`;

    emailDate.appendChild(emailSpan);
    emailRow.appendChild(emailDate);

    const emailContent = document.createElement('div');
    emailContent.classList.add('email-content');

    const emailSender = document.createElement('div');
    emailSender.classList.add('email-sender');

    const emailSenderTitle = document.createElement('h3');
    emailSenderTitle.innerText = mail.sender;
    emailSender.appendChild(emailSenderTitle);
    emailContent.appendChild(emailSender);
    
    const emailMessage = document.createElement('div');
    emailMessage.classList.add('email-message');
    const emailSubject = document.createElement('span');

    emailSubject.classList.add('email-subject');
    emailSubject.innerText = mail.subject;
    emailMessage.appendChild(emailSubject);
    emailContent.appendChild(emailMessage);

    const emailOptions = document.createElement('div');
    emailOptions.classList.add('email-options');
    const lockSpan = document.createElement('span');
    lockSpan.classList.add('material-icons');
    emailOptions.appendChild(lockSpan);
    
    if(mail.isPublic===1){
        lockSpan.classList.add('email-unlocked');
        lockSpan.textContent = 'lock_open';
    }
    else{
        lockSpan.classList.add('email-locked');
        lockSpan.textContent = 'lock';
    }

    emailRow.appendChild(emailContent);
    emailRow.appendChild(emailOptions);

    return emailRow;
}

export {constructEmailVisitorView};