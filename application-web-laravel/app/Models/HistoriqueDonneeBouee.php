<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriqueDonneeBouee extends Model
{
    private $id;
    private $dateSaisie;
    private $temperature;
    private $debit;
    private $salinite;
    private $longitude;
    private $latitude;
    private $batterie;
    private $valide;

    public function __construct($id, $dateSaisie, $temperature, $debit, $salinite, $longitude, $latitude, $batterie, $valide)
    {
        $this->id = $id;
        $this->dateSaisie = $dateSaisie;
        $this->temperature = $temperature;
        $this->debit = $debit;
        $this->salinite = $salinite;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->batterie = $batterie;
        $this->valide = $valide;
    }


    /**
     * @return array
     */
    public function getFillable(): array
    {
        return $this->fillable;
    }

    /**
     * @param array $fillable
     */
    public function setFillable(array $fillable): void
    {
        $this->fillable = $fillable;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    /**
     * @param mixed $dateSaisie
     */
    public function setDateSaisie($dateSaisie): void
    {
        $this->dateSaisie = $dateSaisie;
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * @param mixed $debit
     */
    public function setDebit($debit): void
    {
        $this->debit = $debit;
    }

    /**
     * @return mixed
     */
    public function getSalinite()
    {
        return $this->salinite;
    }

    /**
     * @param mixed $salinite
     */
    public function setSalinite($salinite): void
    {
        $this->salinite = $salinite;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getBatterie()
    {
        return $this->batterie;
    }

    /**
     * @param mixed $batterie
     */
    public function setBatterie($batterie): void
    {
        $this->batterie = $batterie;
    }

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide): void
    {
        $this->valide = $valide;
    }


}
