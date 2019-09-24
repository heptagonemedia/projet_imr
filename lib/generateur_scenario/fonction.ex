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

    def fonction_sinusoidale_normale(instant, min, max, duree_cycle) do
        calcul_amplitude(min, max)*Math.sin(calcul_pulsation(duree_cycle)*instant) + calcul_decalage_en_x(min, max)
    end
end