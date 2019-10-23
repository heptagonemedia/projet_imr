<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonneeTraitee extends Model
{
    protected $id;
    protected $historiqueDonneeBouee;
    protected $valide;

    public function __construct($id, $historiqueDonneeBouee, $valide){
        $this->id = $id;
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
        $this->valide = $valide;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setHistoriqueDonneeBouee($historiqueDonneeBouee){
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
    }

    public function getHistoriqueDonneeBouee(){
        return $this->historiqueDonneeBouee;
    }

    public function setValide($valide){
        $this->valide = $valide;
    }

    public function getValide(){
        return $this->valide;
    }

    public static function mockDonneesTraitees(){
        $tableauDonneesTraitees = array();
        $tableauHistiriquesDonneesBouees = HistoriqueDonneeBouee::mockHistoriqueDonneesBouees();
        array_push($tableauDonneesTraitees, new DonneeTraitee(0, $tableauHistiriquesDonneesBouees[0], true));
        array_push($tableauDonneesTraitees, new DonneeTraitee(1, $tableauHistiriquesDonneesBouees[1], false));
        array_push($tableauDonneesTraitees, new DonneeTraitee(2, $tableauHistiriquesDonneesBouees[2], true));
        return $tableauDonneesTraitees;
    }

}
