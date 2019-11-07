import jdk.internal.org.objectweb.asm.tree.FieldInsnNode;

public interface CalculSQL {

    public static final String SQL_OBTENIR_FK_BOUEE
        = "SELECT id_bouee\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_DATE_DEBUT_CALCUL
        = "SELECT date_debut\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_DATE_FIN_CALCUL
        = "SELECT date_fin\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_FREQUENCE_CALCUL
        = "SELECT frequence\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_FK_TYPE_DONNEE_MESUREE
        = "SELECT id_type_donnee_mesuree\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_FK_TYPE_CALCUL
        = "SELECT id_type_calcul\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul

    //Nouveauté de la base de données
    public static final String SQL_OBTENIR_CHEMIN_FICHIER_XML
        = "SELECT chemin_fichier_xml\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul
    public static final String SQL_OBTENIR_ETIQUETTE_CALCUL
        = "SELECT etiquette\n"
        + "FROM calcul_enregistre\n"
        + "WHERE id_calcul_enregistre = ?"; //id_calcul

    public static final String SQL_OBTENIR_TYPE_CALCUL
        = "SELECT etiquette\n"
        + "FROM type_calcul\n"
        + "WHERE id_type_calcul = ?"; //fk_type_calcul
    public static final String SQL_OBTENIR_VALEURS_LUES
        = "SELECT m.valeur\n"
        + "FROM calcul_enregistre AS ce\n"
        + "JOIN type_donnee_mesuree AS tdm\n"
        + "ON ce.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree\n"
        + "JOIN mesure AS m\n"
        + "ON tdm.id_type_donnee_mesuree = m.id_type_donnee_mesuree\n"
        + "JOIN historique_donnee_bouee AS hdb\n"
        + "ON m.id_historique_donnee_bouee = hdb.id_historique_donnee_bouee\n"
        + "JOIN bouee AS b\n"
        + "ON hdb.id_bouee = b.id_bouee\n"
        + "JOIN donnee_traitee AS dt\n"
        + "ON hdb.id_historique_donnee_bouee = dt.id_historique_donnee_bouee\n"
        + "WHERE b.id_bouee = ?\n" //fk_bouee
        + "AND hdb.date_saisie < ?\n" //date_fin_calcul
        + "AND hdb.date_saisie > ?\n" //date_debut_calcul
        + "AND dt.valide = true";

    public static final String SQL_MISE_A_JOUR_COMPLETE_CALCUL
        = "UPDATE calcul_enregistre "
        + "SET date_debut = ?, date_fin = ?, frequence = ?, valeur = ?, "
        + "id_type_donnee_mesuree = ?, id_type_calcul = ?, prevu = ?, "
        + "chemin_fichier_xml = ?, etiquette = ?, enregistre = ? "
        + "WHERE id_calcul_enregistre = ?";
    public static final String SQL_MISE_A_JOUR_VALEUR_CALCUL
        = "UPDATE calcul_enregistre "
        + "SET valeur = ? "
        + "WHERE id_calcul_enregistre = ?";
}
