import java.net.CookieHandler;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBConnection {
    static String databaseURL = "jdbc:mysql://localhost:3306/empub";
    static String username = "root";
    static String password = "";
    static Connection connection = null;

    public DBConnection() {}

    public static Connection getConnetion() {
        if(connection == null)
            createConnection();

        return connection;
    }

    public static void createConnection() {
        try {
            connection = DriverManager.getConnection(databaseURL, username, password);
            connection.setAutoCommit(false);
        } catch(SQLException e) {
            System.err.println("Cannot connect to DB: " + e);
        }
    }
}
