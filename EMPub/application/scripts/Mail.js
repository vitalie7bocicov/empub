class Mail {
    constructor(mail) {
        this.id = mail.id;
        this.sender = mail.sender;
        this.senderEmail = mail.senderEmail;
        this.subject = mail.subject;
        this.publicationDate = mail.publicationDate;
        this.expirationDate = mail.expirationDate;
    }
}

export { Mail };