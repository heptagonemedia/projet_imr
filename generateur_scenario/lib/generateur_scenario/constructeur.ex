defmodule GenerateurScenario.Constructeur do

    receive do
        {id_scenario, :normal} -> GenerateurScenario.Constructeur.construire(id_scenario, "normal")
    end


    def construire(id_scenario, type) do
        preparer_scenario(id_scenario)
        |> loop(5, type)
        IO.puts "Hey"

    end

    def loop(parametres, n, type) when n <= 1 do
        creer_scenario(parametres, n, type)
    end
    
    def loop(parametres, n, type) do
        creer_scenario(parametres, n, type)
        loop(parametres, n - 1, type)
    end


    def preparer_scenario(id_scenario) do
        %{temperature: GenerateurScenario.Fonction.forger_parametres(Agents.Temperature.value),
        salinite: GenerateurScenario.Fonction.forger_parametres(Agents.Salinite.value),
        debit: GenerateurScenario.Fonction.forger_parametres(Agents.Debit.value),
        batterie: 100,
        id_scenario: id_scenario}
    end

    def creer_scenario(parametres, n, type) do
        scenario = %GenerateurScenario.Scenario{
            id_scenario: parametres.id_scenario,
            seconde: n,
            temperature: GenerateurScenario.Fonction.fonction_sinusoidale(parametres.temperature, n),
            salinite: GenerateurScenario.Fonction.fonction_sinusoidale(parametres.salinite, n),
            debit: GenerateurScenario.Fonction.fonction_sinusoidale(parametres.debit, n),
            longitude: 100.00,
            latitude: 100.00,
            batterie: parametres.batterie
        }

        changeset = GenerateurScenario.Scenario.changeset(scenario, %{})
        GenerateurScenario.Repo.insert(changeset)
    end
end