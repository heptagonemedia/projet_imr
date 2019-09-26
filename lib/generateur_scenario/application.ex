defmodule GenerateurScenario.Application do
  # See https://hexdocs.pm/elixir/Application.html
  # for more information on OTP Applications
  @moduledoc false

  use Application

  def start(_type, _args) do
    children = [
      # Starts a worker by calling: GenerateurScenario.Worker.start_link(arg)
      # {GenerateurScenario.Worker, arg}
      GenerateurScenario.Repo,
    ]

    nomRegion = GenerateurScenario.LireXml.getNomRegion
    temperatureRegion = GenerateurScenario.LireXml.getTemperatureRegion
    saliniteRegion = GenerateurScenario.LireXml.getSaliniteRegion
    debitRegion = GenerateurScenario.LireXml.getDebitRegion

    nbScenario = GenerateurScenario.LireXml.getNbScenario
    scenarioNormaux = GenerateurScenario.LireXml.getScenarioNormaux
    scenarioBase = GenerateurScenario.LireXml.getScenarioBase
    scenarioHybride = GenerateurScenario.LireXml.getScenarioHybride
    scenarioRetardes = GenerateurScenario.LireXml.getScenarioRetarde

    IO.puts nomRegion
    IO.puts temperatureRegion
    IO.puts saliniteRegion
    IO.puts debitRegion

    IO.puts nbScenario
    IO.puts scenarioNormaux
    IO.puts scenarioBase
    IO.puts scenarioHybride
    IO.puts scenarioRetardes

    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: GenerateurScenario.Supervisor]
    Supervisor.start_link(children, opts)
  end
end
