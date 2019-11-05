defmodule Recepteur.Application do
  # See https://hexdocs.pm/elixir/Application.html
  # for more information on OTP Applications
  @moduledoc false

  use Application

  def start(_type, _args) do
    # List all child processes to be supervised
    children = [
      # Start the Ecto repository
      Recepteur.Repo,
      # Start the endpoint when the application starts
      RecepteurWeb.Endpoint
      # Starts a worker by calling: Recepteur.Worker.start_link(arg)
      # {Recepteur.Worker, arg},
    ]

    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: Recepteur.Supervisor]
    Supervisor.start_link(children, opts)


    region = %Recepteur.Region{etiquette: "Ocean Pacifique"}
    bouee = %Recepteur.Bouee{etiquette: "Bouee de test d'insertion des donnees sous TimeScaleDB", longitude_reference: 100.0, latitude_reference: 100.0}

    timestamp = DateTime.truncate(DateTime.utc_now, :second);

    data = %Recepteur.HistoriqueDonneeBouee{id_bouee: 1, longitude_reelle: 105.5, latitude_reelle: 99.92, date_saisie: timestamp, batterie: 100}

    verif = %Recepteur.DonneeTraitee{id_historique_donnee_bouee: 1, valide: true}

    type_data = %Recepteur.TypeDonneeMesuree{etiquette: "Temperature", unite: "degres celsius"}
    mesure = %Recepteur.Mesure{id_historique_donnee_bouee: 1, id_type_donnee: 1, valeur: 24.42}

    Recepteur.Repo.insert(region)
    Recepteur.Repo.insert(bouee)
    Recepteur.Repo.insert(data)
    Recepteur.Repo.insert(verif)
    Recepteur.Repo.insert(type_data)
    Recepteur.Repo.insert(mesure)

    {:ok, self()}

  end

  # Tell Phoenix to update the endpoint configuration
  # whenever the application is updated.
  def config_change(changed, _new, removed) do
    RecepteurWeb.Endpoint.config_change(changed, removed)
    :ok
  end
end
