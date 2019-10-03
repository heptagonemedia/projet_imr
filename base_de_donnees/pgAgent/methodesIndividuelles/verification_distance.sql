--------------------------------------------------------------------------------
--fonction permettant de verifier si la bouée est a moins de 10m de l'emplacement de référence
CREATE OR REPLACE FUNCTION verification_distance(id_historique INT)

    RETURNS boolean
AS $$

DECLARE
    lat1 float;
    lon1 float;
    lat2 float;
    lon2 float;
    x float;
    y float;
BEGIN
    SELECT bouee.latitude_reference,bouee.longitude_reference,hdb.latitude_reelle,hdb.longitude_reelle
    INTO lat1,lon1,lat2,lon2
    FROM historique_donnee_bouee AS hdb
             JOIN bouee ON bouee.id_bouee = hdb.id_bouee;
    x = 111.12 * (lat2 - lat1);
    y = 111.12 * (lon2 - lon1) * cos(lat1 / 92.215);
    RETURN sqrt(x * x + y * y)<0.010;
END
$$ LANGUAGE plpgsql;
