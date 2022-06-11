import java.lang.module.ResolutionException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class AttachmensDAO {
    Connection connection = null;

    AttachmensDAO() {
        connection = DBConnection.getConnetion();
    }

    public void insertAttachment(Attachment attachment) {
        String sql = "insert into attachments(name, contentID, mail_id, relation) values (?, ?, ?, ?)";

        try {
            PreparedStatement stmt = connection.prepareStatement(sql);

            stmt.setString(1, attachment.getName());
            stmt.setString(2, attachment.getContentID());
            stmt.setInt(3, attachment.getMailID());
            stmt.setString(4, attachment.getRelation());

            int rs = stmt.executeUpdate();

            if(rs == 0) {
                // Error Handaling here
            }
            connection.commit();
        }
        catch (SQLException e) {
            System.out.println();
        }

    }

    public String getContentName(String contentId, int userId) {
        String sql = "select name from attachments where contentID = ? and mail_id = ?";
        String fileName = "";

        try {
            PreparedStatement stmt = connection.prepareStatement(sql);

            stmt.setString(1, contentId);
            stmt.setInt(2, userId);
            ResultSet rs = stmt.executeQuery();

            if(rs.next()) {
                fileName = rs.getString(1);
            }
            else
            {
                System.out.println("Come here");
            }

        } catch (SQLException e) {
            System.out.println(e);
        }
        return fileName;
    }
}
