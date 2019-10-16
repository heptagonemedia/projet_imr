defmodule Agents do

    def start() do
        Agents.Compteur.start_link(0)
        Agents.Temperature.start_link(GenerateurScenario.LireXml.get_temperature_la_plus_basse)
        Agents.Salinite.start_link(GenerateurScenario.LireXml.get_salinite_la_plus_basse)
        Agents.Debit.start_link(GenerateurScenario.LireXml.get_debit_le_plus_bas)

    end
end