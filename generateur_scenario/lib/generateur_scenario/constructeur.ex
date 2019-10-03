defmodule GenerateurScenario.Constructeur do
    def construire(id_scenario, type) do
        preparer_scenario(id_scenario)
        |> loop(600, type)
    end

    def loop(parametres, n, type) when n <= 1 do
        IO.puts "Hey"
    end
    
    def loop(parametres, n, type) do
        IO.puts "Hey"
        loop(parametres, n - 1, type)
    end


    def preparer_scenario(id_scenario) do
        %{temp: GenerateurScenario.Fonction.forger_parametres(Agents.Temperature.value),
        salinite: GenerateurScenario.Fonction.forger_parametres(Agents.Salinite.value),
        debit: GenerateurScenario.Fonction.forger_parametres(Agents.Debit.value),
        batterie: 100,
        id_scenario: id_scenario}
    end
end