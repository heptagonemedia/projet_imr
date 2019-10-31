DROP TABLE IF EXISTS calcul_enregistre;
DROP TABLE IF EXISTS type_calcul;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS type_donnee_mesuree;
DROP TABLE IF EXISTS donnee_traitee;
DROP TABLE IF EXISTS historique_donnee_bouee;
DROP TABLE IF EXISTS bouee;
DROP TABLE IF EXISTS region;

--CREATE EXTENSION IF NOT EXISTS timescaledb CASCADE;


CREATE TABLE region(
    id_region serial PRIMARY KEY,
    etiquette text
);


CREATE TABLE bouee(
    id_bouee bigserial PRIMARY KEY,
    etiquette text,
    longitude_reference float,
    latitude_reference float,
    id_region integer,
    CONSTRAINT region_bouee_fk
        FOREIGN KEY (id_region)
        REFERENCES region(id_region)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE historique_donnee_bouee(
    id_historique_donnee_bouee bigserial PRIMARY KEY,
    id_bouee integer,
    longitude_reelle float,
    latitude_reelle float,
    date_saisie timestamp without time zone NOT NULL ,
    batterie integer,
    --primary key (id_historique_donnee_bouee, date_saisie),
    CONSTRAINT bouee_historique_donnee_bouee_fk
        FOREIGN KEY (id_bouee)
        REFERENCES bouee(id_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

--SELECT create_hypertable('historique_donnee_bouee', 'date_saisie');

CREATE TABLE donnee_traitee(
    id_donnee_traitee bigserial PRIMARY KEY,
    id_historique_donnee_bouee integer,
    date_saisie timestamp without time zone,
    valide boolean,
    CONSTRAINT historique_donnee_bouee_donnee_traitee_fk
        FOREIGN KEY (id_historique_donnee_bouee)
        REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE type_donnee_mesuree(
    id_type_donnee_mesuree bigserial PRIMARY KEY,
    etiquette text,
    unite text
);

CREATE TABLE mesure(
    id_mesure bigserial PRIMARY KEY,
    id_historique_donnee_bouee integer,
    date_saisie timestamp without time zone NOT NULL,
    id_type_donnee_mesuree integer,
    valeur float,
    --primary key(id_historique_donnee_bouee, date_saisie),
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

--SELECT create_hypertable('mesure', 'date_saisie');

CREATE TABLE type_calcul(
    id_type_calcul bigserial PRIMARY KEY,
    etiquette text
);

CREATE TABLE calcul_enregistre(
    id_calcul_enregistre bigserial PRIMARY KEY,
    id_bouee bigserial,
    date_debut timestamp without time zone,
    date_fin timestamp without time zone,
    frequence float,
    valeur float,
    id_type_donnee_mesuree integer,
    id_type_calcul integer,
    prevu boolean,
    chemin_fichier_xml text,
    etiquette text,
    enregistre boolean,
    CONSTRAINT type_donnee_mesuree_calcul_enregistre_fk
        FOREIGN KEY (id_type_donnee_mesuree)
        REFERENCES type_donnee_mesuree(id_type_donnee_mesuree)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_calcul_calcul_enregistre_fk
        FOREIGN KEY (id_type_calcul)
        REFERENCES type_calcul(id_type_calcul)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT bouee_calcul_enregistre_fk
        FOREIGN KEY (id_bouee)
        REFERENCES bouee(id_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
