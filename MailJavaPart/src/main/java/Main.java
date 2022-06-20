
import javax.mail.*;
import javax.mail.internet.MimeMultipart;
import javax.mail.search.FlagTerm;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.time.LocalDateTime;
import java.util.*;

public class Main {

    public static void main(String[] args) throws IOException {
        String host = "imap.gmail.com";
        String user = "empub.send@gmail.com";
        String password = "erpzduislscrnhrm";
        try {
            Properties props = new Properties();
            props.setProperty("mail.imap.ssl.enable", "true");

            Session session = Session.getInstance(props);
            Store store = session.getStore( "imap");

            store.connect(host, user, password);

            /*UserDAO userDAO = new UserDAO();
            JavaDAO javaDAO = new JavaDAO();
            MailContentDAO mailContentDAO = new MailContentDAO();
            AttachmensDAO attachmensDAO = new AttachmensDAO();
            LinkCIDUtil linkCIDUtil = new LinkCIDUtil();*/

            while(true) {
                Folder inbox = store.getFolder("INBOX");
                inbox.open(Folder.READ_WRITE);
                Message[] messages = inbox.search(new FlagTerm(new Flags(Flags.Flag.SEEN), false));
                System.out.println(messages.length);

                for(Message msg : messages) {
                    msg.setFlag(Flags.Flag.SEEN, true);

                    MessageThread thread = new MessageThread(msg, inbox.getMessageCount());
                    thread.run();
                }
                inbox.close();
            }
        }
        catch (NoSuchProviderException e) {
            System.out.println("No Such Provider");
        } catch (MessagingException e) {
            e.printStackTrace();
        }
    }

}
