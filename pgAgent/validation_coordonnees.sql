CREATE OR REPLACE FUNCTION distance(lat1 FLOAT, lon1 FLOAT, lat2 FLOAT, lon2 FLOAT)

RETURNS FLOAT
AS $$

DECLARE                                                   
    x float = 111.12 * (lat2 - lat1);                           
    y float = 111.12 * (lon2 - lon1) * cos(lat1 / 92.215);        
BEGIN                                                     
    RETURN sqrt(x * x + y * y);                               
END
$$ LANGUAGE plpgsql;


--fonction de validation fonctionnelle--
CREATE OR REPLACE FUNCTION validation_donnee()

RETURNS void
AS $$

DECLARE                                                   
    curseurDonnee donnee_bouees%rowtype;
	curseurBouee bouees%rowtype;
BEGIN                                                     
    FOR curseurDonnee IN SELECT * FROM donnee_bouees
		LOOP
			SELECT * INTO curseurBouee FROM bouees WHERE id = curseurDonnee.id_bouee;
			IF (distance(curseurBouee.latitude, curseurBouee.longitude, curseurDonnee.latitude, curseurDonnee.longitude) < 0.010) THEN
				INSERT INTO donnee_valides(	id_bouee, 
											temperature, 
											salinite, 
											debit, 
											date_temps, 
											longitude, 
											latitude, 
											batterie)  
										   VALUES(	curseurDonnee.id_bouee, 
													curseurDonnee.temperature, 
													curseurDonnee.salinite, 
													curseurDonnee.debit, 
													curseurDonnee.date_temps, 
													curseurDonnee.longitude, 
													curseurDonnee.latitude, 
													curseurDonnee.batterie);
			ELSE
				INSERT INTO donnee_invalides(id_bouee, 
											temperature, 
											salinite, 
											debit, 
											date_temps, 
											longitude, 
											latitude, 
											batterie)  
										   VALUES(	curseurDonnee.id_bouee, 
													curseurDonnee.temperature, 
													curseurDonnee.salinite, 
													curseurDonnee.debit, 
													curseurDonnee.date_temps, 
													curseurDonnee.longitude, 
													curseurDonnee.latitude, 
													curseurDonnee.batterie);
				
			END IF;
		END LOOP;
END
$$ LANGUAGE plpgsql;




