CREATE OR REPLACE FUNCTION verification_distance(lat1 FLOAT, lon1 FLOAT, lat2 FLOAT, lon2 FLOAT)

RETURNS boolean
AS $$

DECLARE                                                   
    x float = 111.12 * (lat2 - lat1);                           
    y float = 111.12 * (lon2 - lon1) * cos(lat1 / 92.215);        
BEGIN                                                     
    RETURN sqrt(x * x + y * y)<0.010;                               
END
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION validation_donnee()

RETURNS void
AS $$

DECLARE                                                   
    curseurDonnee historique_donnee_bouee%rowtype;
	latRef float;
	lonRef float;
	isValide boolean;
BEGIN                                                     
    FOR curseurDonnee IN SELECT * FROM historique_donnee_bouee
		LOOP
			SELECT latitude_reference,longitude_reference INTO latRef,lonRef FROM bouee WHERE id_bouee = curseurDonnee.id_bouee;
			SELECT INTO isValide verification_distance(latRef,lonRef, curseurDonnee.latitude_reelle, curseurDonnee.longitude_reelle);
			INSERT INTO donnee_traitee(id_historique_donnee_bouee,valide) VALUES(curseurDonnee.id_historique_donnee_bouee,isValide);
		END LOOP;
END
$$ LANGUAGE plpgsql;