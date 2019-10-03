DROP TABLE IF EXISTS calcul_enregistre;
DROP TABLE IF EXISTS type_calcul;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS type_donnee_mesuree;
DROP TABLE IF EXISTS donnee_traitee;
DROP TABLE IF EXISTS historique_donnee_bouee;
DROP TABLE IF EXISTS bouee;
DROP TABLE IF EXISTS region;


CREATE TABLE region(
    id_region serial PRIMARY KEY,
    etiquette text
);

CREATE TABLE bouee(
    id_bouee serial PRIMARY KEY,
    etiquette text,
    longitude_reference float NOT NULL,
    latitude_reference float NOT NULL,
    id_region integer NOT NULL,
    CONSTRAINT region_bouee_fk
        FOREIGN KEY (id_region)
        REFERENCES region(id_region)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE historique_donnee_bouee(
    id_historique_donnee_bouee serial PRIMARY KEY,
    id_bouee integer NOT NULL,
    longitude_reelle float NOT NULL,
    latitude_reelle float NOT NULL,
    date_saisie time with time zone NOT NULL,
    CONSTRAINT bouee_historique_donnee_bouee_fk
        FOREIGN KEY (id_bouee)
        REFERENCES bouee(id_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE donnee_traitee(
    id_donnee_traitee serial PRIMARY KEY,
    id_historique_donnee_bouee integer NOT NULL,
    valide boolean NOT NULL,
    CONSTRAINT historique_donnee_bouee_donnee_traitee_fk
        FOREIGN KEY (id_historique_donnee_bouee)
        REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE type_donnee_mesuree(
    id_type_donnee_mesuree serial PRIMARY KEY,
    etiquette text NOT NULL
);

CREATE TABLE mesure(
    id_mesure serial PRIMARY KEY,
    id_historique_donnee_bouee integer NOT NULL,
    id_type_donnee_mesuree integer NOT NULL,
    valeur float NOT NULL,
    CONSTRAINT historique_donnee_bouee_mesure_fk
        FOREIGN KEY (id_historique_donnee_bouee)
        REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_donnee_mesuree_mesure_fk
        FOREIGN KEY (id_type_donnee_mesuree)
        REFERENCES type_donnee_mesuree(id_type_donnee_mesuree)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE type_calcul(
    id_type_calcul serial PRIMARY KEY,
    etiquette text
);

CREATE TABLE calcul_enregistre(
    id_calcul_enregistre serial PRIMARY KEY,
    date_debut time with time zone NOT NULL,
    date_fin time with time zone NOT NULL,
    frequence float NOT NULL,
    valeur float NOT NULL,
    id_type_donnee_mesuree integer NOT NULL,
    id_type_calcul integer NOT NULL,
    prevu boolean NOT NULL,
    CONSTRAINT type_donnee_mesuree_calcul_enregistre_fk
        FOREIGN KEY (id_type_donnee_mesuree)
        REFERENCES type_donnee_mesuree(id_type_donnee_mesuree)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_calcul_calcul_enregistre_fk
        FOREIGN KEY (id_type_calcul)
        REFERENCES type_calcul(id_type_calcul)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
