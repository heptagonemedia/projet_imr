defmodule SimulateurBouees.MixProject do
  use Mix.Project

  def project do
    [
      app: :simulateur_bouees,
      version: "0.1.0",
      elixir: "~> 1.9",
      start_permanent: Mix.env() == :prod,
      deps: deps()
    ]
  end

  # Run "mix help compile.app" to learn about applications.
  def application do
    [
      extra_applications: [:logger, :ecto, :postgrex],
      mod: {SimulateurBouees.Application, []}
    ]
  end

  # Run "mix help deps" to learn about dependencies.
  defp deps do
    [
      {:ecto_sql, "~> 3.0"},
      {:postgrex, ">= 0.0.0"},
      {:mojito, "~> 0.5.0"},
      {:poison, "~> 3.1"}
    ]
  end
end
