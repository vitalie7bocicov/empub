public class MailContent {
    private String plainText;
    private String html;
    private int mail_id;

    public MailContent() {
    }

    public int getMail_id() {
        return mail_id;
    }

    public void setMail_id(int mail_id) {
        this.mail_id = mail_id;
    }

    public String getPlainText() {
        return plainText;
    }

    public void setPlainText(String plainText) {
        this.plainText = plainText;
    }

    public String getHtml() {
        return html;
    }

    public void setHtml(String html) {
        this.html = html;
    }
}
