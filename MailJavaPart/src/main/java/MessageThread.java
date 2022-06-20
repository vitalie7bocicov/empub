import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Multipart;
import javax.mail.internet.MimeMultipart;
import java.io.FileReader;
import java.io.IOException;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Locale;
import java.util.Properties;
import java.util.ResourceBundle;

public class MessageThread {
    private Message msg;
    private int messageNumber;

    public MessageThread(Message msg, int messageNumber) {
        this.msg = msg;
        this.messageNumber = messageNumber;
    }

    public void setMsg(Message msg) {
        this.msg = msg;
    }

    public void run() {
        Properties propss = new Properties();
        try {
            propss.load(new FileReader("C:\\xampp\\htdocs\\TehnologiiWeb\\MailJavaPart\\src\\main\\resources\\Languaes.properties"));
        } catch (IOException e) {
            e.printStackTrace();
        }

        String languages_string = propss.getProperty("langs");
        List<String> lang = List.of(languages_string.split(" "));

        UserDAO userDAO = new UserDAO();
        JavaDAO javaDAO = new JavaDAO();
        MailContentDAO mailContentDAO = new MailContentDAO();
        AttachmensDAO attachmensDAO = new AttachmensDAO();
        LinkCIDUtil linkCIDUtil = new LinkCIDUtil();

        try {
            MimeMultipart msg2 = (MimeMultipart) msg.getContent();

            String[] from = msg.getHeader("From");

            String fromHeader = from[0];

            String[] splitHeader = fromHeader.split( " ");
            String fromEmailAddress = splitHeader[splitHeader.length - 1];
            fromEmailAddress = fromEmailAddress.substring(1, fromEmailAddress.length() - 1);

            int user_id = userDAO.getUser(fromEmailAddress);

            if(user_id == -1) {
                user_id = userDAO.createUser(fromEmailAddress);
            }

            MailHandler mailHandler = new MailHandler();

            Mail mail = mailHandler.getCurrentMail();

            mail.setUser_id(user_id);
            mail.setExpirationDate(LocalDateTime.now());
            mail.setPublicationDate(LocalDateTime.now());
            mail.setMailNumber(messageNumber);
            mailHandler.setCurrentMail(mail);


                for(int k = 0; k < lang.size(); k++) {
                    Locale local = new Locale(lang.get(k));

                    ResourceBundle resourceBundle = ResourceBundle.getBundle("Bundle", local);
                    Tags tags = new Tags(resourceBundle.getString("password"), resourceBundle.getString("duration"), resourceBundle.getString("from"), resourceBundle.getString("to"), resourceBundle.getString("subject"), resourceBundle.getString("date"));
                    mailHandler.setTags(tags);

                    mailHandler.MessageLookUp(msg2);

                    if(mailHandler.getCurrentMail().getSubject() == null || mailHandler.getCurrentMail().getSender() == null || mailHandler.getCurrentMail().getSenderEmail() == null)
                        continue;
                    Mail currentMail = mailHandler.getCurrentMail();
                    int mail_id = javaDAO.insertEmail(currentMail);
                    currentMail.setId(mail_id);
                    mailHandler.setCurrentMail(currentMail);

                    MailContent mailContent = mailHandler.getMailContent();
                    mailContent.setMail_id(mail_id);

                    List<Attachment> attachments = mailHandler.getAttachments();
                    for(Attachment attachment : attachments) {
                        attachment.setMailID(mail_id);
                        attachmensDAO.insertAttachment(attachment);
                    }

                    mailContent.setHtml(linkCIDUtil.linkCidHtml(mailContent.getHtml(), attachmensDAO, currentMail));
                    mailContentDAO.insert(mailContent);
                    break;
                }
        } catch (MessagingException e) {
            System.out.println(e);
            System.out.println("Message exception");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
