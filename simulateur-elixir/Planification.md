Le générateur doit, dans l'ordre:

Déterminer les ID des scénario à utiliser
Puller les scénario choisis de la BD
Spawner les bouées {
    Bouées = Agent 
    
    start_link() reçoit le scenario en parametre

    Generation commence sans délai

    loop {
        Envoyer la ligne de données au concentrateur 

        attendre une seconde
    }

}