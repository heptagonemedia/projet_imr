<?php

class BaseDeDonnees
{
    private static $instance;

    private $connection;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new BaseDeDonnees();
        }
        return self::$instance;
    }

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "pgsql:host=" . BDD_hote . ";port=" . BDD_port . ";dbname=" . BDD_base_de_donnees,
                BDD_usager,
                BDD_mot_de_passe);
            $this->connection->exec("set names utf8");
            // pour récupérer le résultat des requêtes SELECT sous la forme d'un tableau associatif
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            // pour afficher les erreurs
//            $this->connectionb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $exception) {
//            echo $exception->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}