public interface AccesBDD {

    /*
    //Valeurs finales
    static final String DRIVER_BASE_DE_DONNEES = "org.postgresql.Driver";
    static final String URL_BASE_DE_DONNEES = "jdbc:postgresql://vpsloic.loicbertrand.net:1132/imr";
    static final String UTILISATEUR_BASE_DE_DONNEES = "heptagonemedia";
    static final String MOT_DE_PASSE_BASE_DE_DONNEES = "Motivation*";
    */

    //Valeurs de test en local
    static final String DRIVER_BASE_DE_DONNEES = "org.postgresql.Driver";
    static final String URL_BASE_DE_DONNEES = "jdbc:postgresql://localhost:5432/projet_imr";
    static final String UTILISATEUR_BASE_DE_DONNEES = "userLambda";
    static final String MOT_DE_PASSE_BASE_DE_DONNEES = "datenbankschlussel";

    //Le java n'a pas besoin d'être mis en ligne, donc on n'a pas besoin
    //de sécuriser les id, pswd plus que ça.

}
