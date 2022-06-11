import java.time.LocalDateTime;
import java.util.Date;

public class Mail {
    private int id;
    private int mailNumber;
    private String subject;
    private String sender;
    private String senderEmail;
    private boolean publicParam;
    private String password;
    private LocalDateTime expirationDate;
    private LocalDateTime publicationDate;
    private int user_id;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUser_id() {
        return user_id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public LocalDateTime getPublicationDate() {
        return publicationDate;
    }

    public void setPublicationDate(LocalDateTime publicationDate) {
        this.publicationDate = publicationDate;
    }

    public LocalDateTime getExpirationDate() {
        return expirationDate;
    }

    public void setExpirationDate(LocalDateTime expirationDate) {
        this.expirationDate = expirationDate;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public boolean isPublicParam() {
        return publicParam;
    }

    public void setPublicParam(boolean publicParam) {
        this.publicParam = publicParam;
    }


    public Mail() {}

    public int getMailNumber() {
        return mailNumber;
    }

    public void setMailNumber(int mailNumber) {
        this.mailNumber = mailNumber;
    }

    public Mail(String subject, String sender, String senderEmail) {

        this.subject = subject;
        this.sender = sender;
        this.senderEmail = senderEmail;
    }

    public String getSubject() {
        return subject;
    }

    public void setSubject(String subject) {
        this.subject = subject;
    }

    public String getSender() {
        return sender;
    }

    public void setSender(String sender) {
        this.sender = sender;
    }

    public String getSenderEmail() {
        return senderEmail;
    }

    public void setSenderEmail(String senderEmail) {
        this.senderEmail = senderEmail;
    }
}
