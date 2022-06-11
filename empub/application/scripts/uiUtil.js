function appenEmail(mail) {
    const emailRow = document.createElement('div');
    emailRow.classList.add('email-row');

    emailRow.setAttribute('id', mail.id);
    emailRow.addEventListener('click', () => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/email/${mail.id}`;
    });
    const emailDate = document.createElement('div');
    emailDate.classList.add('email-date');
    const spanDate = document.createElement('span');
    spanDate.classList.add('email-expiration-date');

    let publicationDate = new Date(mail.publicationDate);
    spanDate.innerText = `${publicationDate.getDate()}/${publicationDate.getMonth()}/${publicationDate.getFullYear()}`; 

    emailDate.appendChild(spanDate);
    
    const emailContent = document.createElement('div');
    emailContent.classList.add('email-content');

    const emailSender = document.createElement('div');
    emailSender.classList.add('email-sender');
    const emailSenderTitle = document.createElement('h3');
    emailSenderTitle.innerText = mail.sender;
    emailSender.appendChild(emailSenderTitle);

    const emailMessage = document.createElement('div');
    emailMessage.classList.add('email-message');
    const emailSubject = document.createElement('span');
    const emailText = document.createElement('span');

    emailText.classList.add('email-text');
    emailSubject.classList.add('email-subject');
    emailSubject.innerText = mail.subject;
    emailMessage.appendChild(emailSubject);
    emailMessage.appendChild(emailText);

    emailContent.appendChild(emailSender);
    emailContent.appendChild(emailMessage);

    const emailLock = document.createElement('a');
    const emailSettings = document.createElement('a');
    const emailStats = document.createElement('a');
    const emailDelete = document.createElement('a');

    const emailOptions = document.createElement('div');
    emailOptions.classList.add('email-options');

    const material_icons_span1 = document.createElement('span');
    const material_icons_span2 = document.createElement('span');
    const material_icons_span3 = document.createElement('span');
    const material_icons_span4 = document.createElement('span');
    const emailViews = document.createElement('span');
    emailViews.classList.add('email-views');
    material_icons_span1.classList.add('material-icons');
    material_icons_span1.classList.add('email-locked');
    material_icons_span2.classList.add('material-icons');
    material_icons_span3.classList.add('material-icons');
    material_icons_span4.classList.add('material-icons');
    material_icons_span1.textContent = 'lock';
    material_icons_span2.textContent = 'settings';
    material_icons_span3.textContent = 'query_stats';
    material_icons_span4.textContent = 'delete';

    emailLock.appendChild(material_icons_span1);
    emailLock.classList.add('email-lock');

    emailSettings.appendChild(material_icons_span2);
    emailSettings.classList.add('email-settings');

    emailStats.appendChild(material_icons_span3);
    emailStats.appendChild(emailViews);
    emailStats.classList.add('email-stats');


    emailDelete.appendChild(material_icons_span4);
    emailDelete.classList.add('email_delete');

    emailOptions.appendChild(emailLock);
    emailOptions.appendChild(emailSettings);
    emailOptions.appendChild(emailStats);
    emailOptions.appendChild(emailDelete);


    emailRow.appendChild(emailDate);
    emailRow.appendChild(emailContent);
    emailRow.appendChild(emailOptions);

    return emailRow;
}

export {appenEmail};