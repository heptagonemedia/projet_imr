DROP TABLE IF EXISTS resultat;
DROP TABLE IF EXISTS calcul;
DROP TABLE IF EXISTS type_calcul;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS type_donnee;
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
    id_historique_donnee_bouee serial PRIMARY KEY,
    id_bouee integer,
    longitude_reelle float,
    latitude_reelle float,
    batterie integer,
    date_saisie timestamp without time zone,
    CONSTRAINT bouee_historique_donnee_bouee_fk
        FOREIGN KEY (id_bouee)
        REFERENCES bouee(id_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE donnee_traitee(
    id_donnee_traitee serial PRIMARY KEY,
    id_historique_donnee_bouee integer,
    valide boolean,
    CONSTRAINT historique_donnee_bouee_donnee_traitee_fk
        FOREIGN KEY (id_historique_donnee_bouee)
        REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE type_donnee(
    id_type_donnee serial PRIMARY KEY,
    etiquette text,
    unite text
);

CREATE TABLE mesure(
    id_mesure serial PRIMARY KEY,
    valeur float,
    id_historique_donnee_bouee integer,
    id_type_donnee integer,
    CONSTRAINT historique_donnee_bouee_mesure_fk
        FOREIGN KEY (id_historique_donnee_bouee)
        REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_donnee_mesure_fk
        FOREIGN KEY (id_type_donnee)
        REFERENCES type_donnee(id_type_donnee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE type_calcul(
    id_type_calcul serial PRIMARY KEY,
    etiquette text
);

CREATE TABLE calcul(
    id_calcul serial PRIMARY KEY,
    etiquette text,
    date_generation timestamp without time zone,
    date_prochaine_generation timestamp without time zone,
    date_debut_plage timestamp without time zone,
    date_fin_plage timestamp without time zone,
    frequence_valeur float,
    enregistre boolean,
    id_bouee integer,
    id_type_calcul integer,
    CONSTRAINT bouee_calcul_fk
        FOREIGN KEY (id_bouee)
        REFERENCES bouee(id_bouee)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_calcul_calcul_fk
        FOREIGN KEY (id_type_calcul)
        REFERENCES type_calcul(id_type_calcul)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE resultat(
    id_resultat serial PRIMARY KEY,
    id_type_donnee integer,
    id_calcul integer,
    chemin_fichier_xml text,
    CONSTRAINT calcul_resultat
        FOREIGN KEY (id_calcul)
        REFERENCES calcul(id_calcul)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT type_donnee_resultat
        FOREIGN KEY (id_type_donnee)
        REFERENCES type_donnee(id_type_donnee)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
