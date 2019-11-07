import java.sql.*;
// import java.util.Date;
import java.util.ArrayList;
import java.util.List;

public class CalculEnregistreDAO implements CalculSQL {

    private Connection connection = null;

    public CalculEnregistreDAO() {
            this.connection = ConnexionBDD.getInstance().getConnection();
    }

    public long obtenirFKboueeLiee(long idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_FK_BOUEE);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();
            curseurReponseBaseDeDonnees.next();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getLong("id_bouee");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return -1; //Signal d'erreur
    }

    public Timestamp obtenirDateDebutCalcul(long idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_DATE_DEBUT_CALCUL);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();
            curseurReponseBaseDeDonnees.next();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getTimestamp("date_debut");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public Timestamp obtenirDateFinCalcul(long idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_DATE_FIN_CALCUL);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();
            curseurReponseBaseDeDonnees.next();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getTimestamp("date_fin");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public int obtenirFKtypeCalcul(long idCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_FK_TYPE_CALCUL);
            requeteBaseDeDonnees.setLong(1, idCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();
            curseurReponseBaseDeDonnees.next();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getInt("id_type_calcul");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return -1; //Signal d'erreur
    }

    public String obtenirChampTypeCalcul(int fkTypeCalcul) {
        PreparedStatement requeteBaseDeDonnees;
        try {
            //On prépare la requête à la base de données
            requeteBaseDeDonnees = connection.prepareStatement(SQL_OBTENIR_TYPE_CALCUL);
            requeteBaseDeDonnees.setLong(1, fkTypeCalcul);

            //On exécute la requête
            ResultSet curseurReponseBaseDeDonnees = requeteBaseDeDonnees.executeQuery();
            curseurReponseBaseDeDonnees.next();

            //On récupère la réponse de la base de données
            return curseurReponseBaseDeDonnees.getString("etiquette");
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public List<Double> obtenirValeursPourCalcul(long idBouee, Timestamp dateDebutCalcul, Timestamp dateFinCalcul) {
        //débug
        //System.out.println("idBouee : " + idBouee
        //        + "date début : " + dateDebutCalcul
        //        + "date fin : " + dateFinCalcul);

        List<Double> valeursLues = new ArrayList<Double>();
        PreparedStatement requeteLectureCalculEnregistre;
        try {
            //On prépare la requête à la base de données
            requeteLectureCalculEnregistre = connection.prepareStatement(SQL_OBTENIR_VALEURS_LUES);
            requeteLectureCalculEnregistre.setLong(1, idBouee);
            requeteLectureCalculEnregistre.setTimestamp(2, dateFinCalcul);
            requeteLectureCalculEnregistre.setTimestamp(3, dateDebutCalcul);

            //On exécute la requête
            ResultSet curseurCalculEnregistre = requeteLectureCalculEnregistre.executeQuery();

            //On récupère la réponse de la base de données
            while(curseurCalculEnregistre.next()) {
                valeursLues.add(curseurCalculEnregistre.getDouble("valeur"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return valeursLues;
    }

    public List<Double> obtenirValeursPretesAuCalcul(long idCalcul) {
        long fkBoueeLiee;
        Timestamp dateDebutCalcul, dateFinCalcul;

        fkBoueeLiee = obtenirFKboueeLiee(idCalcul);
        dateDebutCalcul = obtenirDateDebutCalcul(idCalcul);
        dateFinCalcul = obtenirDateFinCalcul(idCalcul);

        return obtenirValeursPourCalcul(fkBoueeLiee, dateDebutCalcul, dateFinCalcul);
    }

    public String obtenirChampTypeCalculPretAuCalcul(long idCalcul) {
        int fkTypeCalcul;

        fkTypeCalcul = obtenirFKtypeCalcul(idCalcul);
        return obtenirChampTypeCalcul(fkTypeCalcul);
    }

    public void modifierValeurCalcul(double valeurAinserer, long idCalcul) {
        //System.out.println("CalculEnregistreDAO.modifierValeurCalcul()");
        try {
            //On prépare la requête à la base de données
            PreparedStatement requetePourModifierCalcul = connection.prepareStatement(SQL_MISE_A_JOUR_VALEUR_CALCUL);
            requetePourModifierCalcul.setDouble(1, valeurAinserer);
            requetePourModifierCalcul.setLong(2, idCalcul); //WHERE CLAUSE

            //On l'exécute
            requetePourModifierCalcul.execute();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
