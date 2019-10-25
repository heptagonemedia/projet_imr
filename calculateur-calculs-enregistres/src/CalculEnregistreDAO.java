import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CalculEnregistreDAO implements CalculSQL {

    private Connection connection = null;

    public CalculEnregistreDAO() {
            this.connection = ConnexionBDD.getInstance().getConnection();
    }

    public Date obtenirDateDebutCalcul(int idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_DATE_DEBUT_CALCUL);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getDate("date_debut");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public Date obtenirDateFinCalcul(int idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_DATE_FIN_CALCUL);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getDate("date_fin");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    //wip.

    public List<Float> obtenirValeursPourCalcul(long idBouee, Date dateDebutCalcul, Date dateFinCalcul) {

        List<Float> valeursLues = new ArrayList<Float>();
        PreparedStatement requeteLectureCalculEnregistre;
        try {
            //On prépare la requête à la base de données
            requeteLectureCalculEnregistre = connection.prepareStatement(SQL_OBTENIR_VALEURS_LUES);
            requeteLectureCalculEnregistre.setLong(1, idBouee);
            requeteLectureCalculEnregistre.setDate(2, dateFinCalcul);
            requeteLectureCalculEnregistre.setDate(3, dateDebutCalcul);

            //On exécute la requête
            ResultSet curseurCalculEnregistre = requeteLectureCalculEnregistre.executeQuery();

            //On récupère la réponse de la base de données
            while(curseurCalculEnregistre.next()) {
                valeursLues.add(curseurCalculEnregistre.getFloat("valeur"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return valeursLues;
    }

    public void modifierValeurCalcul(float valeurAinserer, long idCalcul) {
        System.out.println("CalculEnregistreDAO.modifierValeurCalcul()");
        try {
            //On prépare la requête à la base de données
            PreparedStatement requetePourModifierCalcul = connection.prepareStatement(SQL_MISE_A_JOUR_COMPLETE_CALCUL);
            requetePourModifierCalcul.setFloat(1, valeurAinserer);
            requetePourModifierCalcul.setLong(2, idCalcul); //WHERE CLAUSE

            //On l'exécute
            requetePourModifierCalcul.execute();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
