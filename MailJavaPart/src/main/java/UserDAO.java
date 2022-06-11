import java.sql.*;

public class UserDAO {
    Connection connection = null;

    public UserDAO() { connection = DBConnection.getConnetion(); }

    public int getUser(String email) {
        String sql = "select id from users where email = ?";

        try {
            PreparedStatement stmt = connection.prepareStatement(sql);
            stmt.setString(1, email);

            ResultSet rs = stmt.executeQuery();

            if(!rs.next()) {

            }
            int user_id = rs.getInt("id");
            return user_id;
        } catch (SQLException e) {

        }
        return -1;
    }

    public int createUser(String email) {
        String sql = "insert into users(email) values (?)";

        try {
            PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);

            stmt.setString(1, email);
            int rs = stmt.executeUpdate();
            if(rs == 0) {
                // Got an error
            }

            ResultSet keys = stmt.getGeneratedKeys();
            if(keys.next()) {
                connection.commit();
                return keys.getInt(1);
            }
        } catch (SQLException e) {
            System.out.println("Error at user creation");
        }

        return -1;
    }

}
