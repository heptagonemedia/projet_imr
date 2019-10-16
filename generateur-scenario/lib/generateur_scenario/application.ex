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
      {Agents.Compteur, 0},
      # {Agents.Temperature, GenerateurScenario.LireXml.convertir_temperature_map},
      # {Agents.Debit, GenerateurScenario.LireXml.convertir_debit_map},
      # {Agents.Salinite, GenerateurScenario.LireXml.convertir_salinite_map}
      {Agents.Temperature, %{min: 5, max: 30}},
      {Agents.Debit, %{min: 5, max: 30}},
      {Agents.Salinite, %{min: 5, max: 30}}
    ]
    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: GenerateurScenario.Supervisor]
    Supervisor.start_link(children, opts)


    GenerateurScenario.start(30, 0, 0, 0)

    {:ok, self()}
  end
end
