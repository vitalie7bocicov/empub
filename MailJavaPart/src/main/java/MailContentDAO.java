import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class MailContentDAO {
    Connection connection = null;

    public MailContentDAO() {
        connection = DBConnection.getConnetion();
    }

    public void insert(MailContent mailContent) {
        String sql = "insert into mail_contents(plainText, htmlText, mail_id) values (?, ?, ?)";

        try {
            PreparedStatement pstmt = connection.prepareStatement(sql);

            pstmt.setString(1, mailContent.getPlainText());
            pstmt.setString(2, mailContent.getHtml());
            pstmt.setInt(3, mailContent.getMail_id());

            int rs = pstmt.executeUpdate();

            if(rs == 0) {
                //Error at creatino of mail Content
            }
            connection.commit();

        } catch (SQLException e) {


        }
    }
}
