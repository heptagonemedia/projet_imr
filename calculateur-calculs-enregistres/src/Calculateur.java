import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class Calculateur {

    private final String MOYENNE = "moyenne";
    private final String ECART_TYPE = "ecart type";
    private final String MEDIANE = "mediane";

    private List<Double> tableauDeValeurs = new ArrayList<Double>();
    private String typeCalcul;
    private double moyenne, resultat;
    private int tailleTableauValeursLues;
    private CalculEnregistreDAO calculDAO;

    public Calculateur() {
        typeCalcul = "";
        moyenne = 0.0;
        resultat = 0.0;
        tailleTableauValeursLues = 0;
        calculDAO = new CalculEnregistreDAO();
    }

    public void calculer(long idCalcul) {
        tableauDeValeurs = calculDAO.obtenirValeursPretesAuCalcul(idCalcul);
        tailleTableauValeursLues = tableauDeValeurs.size();
        typeCalcul = calculDAO.obtenirChampTypeCalculPretAuCalcul(idCalcul);

        //DÉBUG
        //for(double valeurLue : tableauDeValeurs) {
        //    System.out.println("val : " + valeurLue);
        //}

        if(typeCalcul.equals(MOYENNE)) {
            //System.out.println("MOYENNE");
            for(double valeurLue : tableauDeValeurs) {
                resultat += valeurLue;
            }
            resultat /= tailleTableauValeursLues;

        } else if(typeCalcul.equals(ECART_TYPE)) {
            //System.out.println("ÉCART TYPE");
            for(double valeurLue : tableauDeValeurs) {
                moyenne += valeurLue;
            }
            moyenne /= tailleTableauValeursLues;
            for(double valeurLue : tableauDeValeurs) {
                resultat = Math.pow((valeurLue-moyenne), 2.0);
            }
            resultat = Math.sqrt((1.0/tailleTableauValeursLues)*resultat);

        } else if(typeCalcul.equals(MEDIANE)) {
            //System.out.println("MÉDIANE");
            Collections.sort(tableauDeValeurs);
            if(tailleTableauValeursLues%2!=0) {
                resultat = tableauDeValeurs.get(tailleTableauValeursLues/2);
            } else {
                resultat = (tableauDeValeurs.get((tailleTableauValeursLues/2)-1)+tableauDeValeurs.get(tailleTableauValeursLues/2))/2;
            }
        } else {
            // Erreur
            System.out.println("ERREUR idCalcul : " + idCalcul + " → mauvais type_calcul");
            resultat = -1;
        }
        //System.out.println("résultat = " + resultat);
        calculDAO.modifierValeurCalcul(resultat, idCalcul);
    }
}
