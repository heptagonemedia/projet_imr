defmodule Agents do

    def start() do
        Agents.Compteur.start_link(0)
        Agents.Temperature.start_link(GenerateurScenario.LireXml.getTemperatureRegion)
        Agents.Salinite.start_link(GenerateurScenario.LireXml.getSaliniteRegion)
        Agents.Debit.start_link(GenerateurScenario.LireXml.getDebitRegion)

    end
end