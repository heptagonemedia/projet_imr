CREATE OR REPLACE FUNCTION distance(lat1 FLOAT, lon1 FLOAT, lat2 FLOAT, lon2 FLOAT) RETURNS FLOAT AS $$
DECLARE                                                   
    x float = 111.12 * (lat2 - lat1);                           
    y float = 111.12 * (lon2 - lon1) * cos(lat1 / 92.215);        
BEGIN                                                     
    RETURN sqrt(x * x + y * y);                               
END
$$ LANGUAGE plpgsql;


INSERT INTO donnee_valides(id_bouee, temperature, salinite, debit,  date_temps, longitude, latitude,batterie) 
SELECT donnee_bouees.id_bouee,donnee_bouees.temperature,donnee_bouees.salinite,donnee_bouees.debit,donnee_bouees.date_temps,donnee_bouees.longitude,donnee_bouees.latitude,donnee_bouees.batterie
FROM donnee_bouees
LEFT JOIN bouees
ON bouees.id = donnee_bouees.id_bouee
WHERE distance(bouees.latitude,bouees.longitude,donnee_bouees.latitude,donnee_bouees.longitude) < 0.010;
