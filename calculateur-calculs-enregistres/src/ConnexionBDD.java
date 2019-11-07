import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConnexionBDD {
    private Connection connection = null;

    private ConnexionBDD() {
        try {
            Class.forName(AccesBDD.DRIVER_BASE_DE_DONNEES);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
        try {
            connection = DriverManager.getConnection(AccesBDD.URL_BASE_DE_DONNEES, AccesBDD.UTILISATEUR_BASE_DE_DONNEES, AccesBDD.MOT_DE_PASSE_BASE_DE_DONNEES);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // SINGLETON - DÉBUT
    private static ConnexionBDD instance = null;
    public static ConnexionBDD getInstance() {
        if(null == instance) instance = new ConnexionBDD();
        return instance;
    }
    // SINGLETON - FIN

    public Connection getConnection() {
        return this.connection;
    }

}
