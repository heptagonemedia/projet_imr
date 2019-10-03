--------------------------------------------------------------------------------
-- fonction de vérification des données reçues d'une bouée.

CREATE OR REPLACE FUNCTION verification_donnees_bouee(id_historique INT)

    RETURNS BOOLEAN
    LANGUAGE 'plpgsql'

AS $BODY$

DECLARE
    verification_salinite BOOLEAN;
    verification_debit BOOLEAN;
    verification_temperature BOOLEAN;
    verification_distance BOOLEAN;

BEGIN
    verification_salinite := nouveau_intervale_incertitude(id_historique, 'salinite');
    verification_debit := nouveau_intervale_incertitude(id_historique, 'debit');
    verification_temperature := nouveau_intervale_incertitude(id_historique, 'temperature');
    verification_distance := verification_distance(id_historique);

    -- plpgsql ne gère pas de return direct, on doit passer par if then else
    IF verification_salinite <> FALSE
        AND verification_debit <> FALSE
        AND verification_temperature <> FALSE
        AND verification_distance <> FALSE
    THEN
        RETURN TRUE;
        -- Si l'échantillon n'est pas assez représentatif pour executer nouveau_intervale_incertitude
        -- on considère que la valeur est fiable (pour les n premières données d'une bouées, 25 par exemple).
        -- Le but est de permettre la constitution d'un échatillon pour pouvoir, ensuite, vérifier les données.
    ELSE
        RETURN FALSE;
    END IF;

END;

$BODY$;