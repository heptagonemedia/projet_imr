public class CalculateurJava {
    public static void main(String[] args){
        //long idCalcul = Long.parseLong(args[0]);

        //pour le débug
        long idCalcul = 1;

        Calculateur calculateur = new Calculateur();
        //System.out.println("idCalcul : " + idCalcul);
        calculateur.calculer(idCalcul);
    }
}
