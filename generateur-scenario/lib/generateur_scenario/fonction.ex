defmodule GenerateurScenario.Fonction do


    def calcul_amplitude(map) do
        Map.put_new(map, :amplitude, (map.max - map.min)/2)
    end

    def calcul_pulsation(map) do
        duree_cycle = 600
        Map.put_new(map, :pulsation, 2 * Math.pi() / duree_cycle)
    end

    def calcul_decalage_en_x(map) do
        Map.put_new(map, :decalage_en_x, Enum.random(map.min..map.max))
    end

    def fonction_sinusoidale(map, instant) do
        map.amplitude + Math.sin(map.pulsation * instant) + map.decalage_en_x
    end

    @spec fonction_batterie_normale(number, number, number) :: number
    def fonction_batterie_normale(instant, coefficient, ordonnee_origine) do
        coefficient * instant + ordonnee_origine
    end

    def fonction_affine_anormale_croissante(instant) do
        40*instant + 5
    end

    def fonction_affine_anormale_decroissante(instant) do
        -40*instant + 5
    end

    def forger_parametres(map) do
        calcul_amplitude(map)
        |> calcul_pulsation()
        |> calcul_decalage_en_x()
    end
end
