import org.apache.commons.codec.digest.DigestUtils;

import java.sql.*;

public class JavaDAO {
    Connection connection = null;

    public JavaDAO() {
        connection = DBConnection.getConnetion();
    }

    public int insertEmail(Mail mail) {
        String insertMail = "insert into mails(senderName, senderEmailAddress, subject, publication_date, expiration_date, public, PASSWORD, user_id, views) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            PreparedStatement pstmt = connection.prepareStatement(insertMail, Statement.RETURN_GENERATED_KEYS);

            String digest = null;
            if(mail.getPassword() != null) {
                digest = DigestUtils.sha256Hex(mail.getPassword());
            }

            pstmt.setString(1, mail.getSender());
            pstmt.setString(2, mail.getSenderEmail());
            pstmt.setString(3, mail.getSubject());
            pstmt.setTimestamp(4, Timestamp.valueOf(mail.getPublicationDate()));
            pstmt.setTimestamp(5, Timestamp.valueOf(mail.getExpirationDate()));
            pstmt.setBoolean(6, mail.isPublicParam());
            pstmt.setString(7, digest);
            pstmt.setInt(8, mail.getUser_id());
            pstmt.setInt(9, 0);
            int rs = pstmt.executeUpdate();

            if(rs == 0)  {
                System.out.println("sadasdasdasd");
                // Error at mail creation
            }

            ResultSet generatedKey = pstmt.getGeneratedKeys();

            if(generatedKey.next()) {
                connection.commit();
                return generatedKey.getInt(1);
            }
        } catch (SQLException e) {
            System.out.println(e);
        }

        return -1;
    }

}
