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

    //TODO
    public function insert($champs,$nomTable){
        
    }

    //TODO
    public function update($champs,$nomTable,$condition){
        
    }

    //TODO
    public function select($champs,$nomTable,$condition){
        // foreach ($champ as $key => $value) {
        //     # code...
        // }

        // $result = pg_query($c,"SELECT * FROM account ");
        // $row = pg_fetch_all($result); 

        // return $row;
    }


    private function init(){
        $this->nom_bdd = "test";
        $this->identifiant = "generateurXML";
        $this->motdepasse = "xml";
        $this->infos_bdd = "host=localhost port=5432 dbname=". $this->nom_bdd ." user=".$this->identifiant." password=".$this->motdepasse;
    }


}
