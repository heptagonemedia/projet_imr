defmodule Agents do

    def start() do
        Agents.Compteur.start_link(0)
        Agents.Temperature.start_link(GenerateurScenario.LireXml.get_temperature_basse_region)
        Agents.Salinite.start_link(GenerateurScenario.LireXml.get_salinite_region)
        Agents.Debit.start_link(GenerateurScenario.LireXml.get_debit_region)

    end
end