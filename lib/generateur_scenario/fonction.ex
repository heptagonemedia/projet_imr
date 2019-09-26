defmodule GenerateurScenario.Fonction do


    def calcul_amplitude(min, max) do
        (max - min)/2
    end

    def calcul_pulsation(duree_cycle) do
        2 * Math.pi() / duree_cycle
    end

    def calcul_decalage_en_x(min, max) do
        max - calcul_amplitude(min, max)
    end

    @spec fonction_sinusoidale_normale(number, number, number, number) :: float
    def fonction_sinusoidale_normale(instant, min, max, duree_cycle) do
        calcul_amplitude(min, max)*Math.sin(calcul_pulsation(duree_cycle)*instant) + calcul_decalage_en_x(min, max)
    end

    def fonction_sinusoidale_anormale(instant, duree_cycle, decalage) do
        calcul_amplitude(decalage - 2, decalage + 2)*Math.sin(calcul_pulsation(duree_cycle)*instant) + decalage
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
end
