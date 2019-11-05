<?php

class BaseDeDonnees
{

    /* les infos */
    private $nom_bdd = "";
    private $identifiant = "";
    private $motdepasse = "";
    private $infos_bdd = "";

    private $lien_bdd = "";

    public function __construct() {
        
        //"host=localhost port=5432 dbname=test user=generateurXML password=xml"        
        
        $this->init();

        // $result = pg_query($c,"SELECT * FROM account ");
        // $row = pg_fetch_all($result); 

        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';

    }

    public function connect(){
        $this->lien_bdd = pg_connect($this->infos_bdd);
    }

    public function getLien(){
        return $this->lien_bdd;
    }

    public function disconnect(){
        pg_close($this->lien_bdd);
    }

   
    public function insert($champs,$nomTable,$link){

        array_pop($champs);

        $sql = "INSERT INTO " . $nomTable . "(
            type,
            prendre_compte,
            valeur_depart_temperature,
            erreur_temperature,
            valeur_depart_debit,
            erreur_debit,
            valeur_depart_salinite,
            erreur_salinite,
            valeur_depart_longitude,
            erreur_longitude,
            valeur_depart_latitude,
            erreur_latitude,
            valeur_depart_batterie,
            valeur_decrementation_batterie,
            description      
        ) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15);";

        echo($sql);

        $result = pg_prepare($link,"insertion_scenario",$sql);

        $result = pg_execute($link, "insertion_scenario",$champs);

        return $result;

    }

    //TODO
    public function update($champs,$nomTable,$condition){
        
    }

    //TODO
    public function select($champs,$nomTable,$condition){
        
    }


    private function init(){
        $this->nom_bdd = "generation_scenario";
        $this->identifiant = "generateur_scenario";
        $this->motdepasse = "scenario";
        $this->infos_bdd = "host=localhost port=5432 dbname=". $this->nom_bdd ." user=".$this->identifiant." password=".$this->motdepasse;
    }


}
