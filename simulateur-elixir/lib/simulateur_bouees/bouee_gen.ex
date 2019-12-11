defmodule SimulateurBouees.BoueeGen do
  use Agent
  require Logger
  require IEx

  def start_link(initial) do
    IO.puts :startgen
    {:ok, state} = init(initial)
    Agent.start_link(process(state))
  end

  def init(initial) do
    temperature = Enum.random(5..10)
    salinite = Enum.random(5..10)
    debit = Enum.random(5..10)
    latitude = :rand.uniform(20) # TODO corriger 
    longitude = :rand.uniform(20)# TODO corriger 
    batterie = 100
    dernieres_valeurs = %{temperature: temperature, salinite: salinite, debit: debit, longitude: longitude, latitude: latitude, batterie: batterie}
    state = %{id_bouee: initial.idbouee, scenario: initial.scenario, dernieres_valeurs: dernieres_valeurs }
    {:ok, state}
  end

  def process(state) do
    receive do
      after
        1_000 ->
          generer(state)
          process(state)
    end
  end

  def calcul(lastval, errval) do
    valeur = errval + 0.95
    random = :rand.uniform_real() * 0.1
    valeur2 = valeur + random
    lastval + valeur2
  end

  def decrementBatterie(valeur, decrement) do
    if (:rand.uniform_real > 0.5 ) do
      valeur
    else 
      valeur - decrement
    end
  end

  def generer(state) do

    last = state.dernieres_valeurs
    scenario = List.first(state.scenario) 

    temperature = Decimal.to_string(calcul(last.temperature, scenario.erreur_temperature))
    salinite = Decimal.to_string(calcul(last.salinite, scenario.erreur_salinite))
    debit = Decimal.to_string(calcul(last.debit, scenario.erreur_debit))
    Map.replace!(state, :dernieres_valeurs, %{temperature: temperature, salinite: salinite, debit: debit})

    latitude = Decimal.to_string(calcul(last.latitude, scenario.erreur_latitude))
    longitude = Decimal.to_string(calcul(last.longitude, scenario.erreur_longitude))
    batterie = decrementBatterie(last.batterie, scenario.valeur_decrementation_batterie)
    moment = DateTime.to_string(DateTime.utc_now)

    Map.replace!(state, :dernieres_valeurs, %{last | latitude: latitude, longitude: longitude, batterie: batterie})

    data = %{id_bouee: state.id_bouee, latitude_reelle: latitude, longitude_reelle: longitude, 
    date_saisie: moment, batterie: batterie, temperature: temperature, salinite: salinite, debit: debit}

    # IO.inspect data
    {:ok, body} = Poison.encode(data)

    Mojito.post(
      # "http://localhost:3000/",
      "https://putsreq.com/vjJng1E7cT0TFdiE00DJ",
      [],
      body
    )

    # IO.inspect body
    # SimulateurBouees.EmetteurMint.request(state.pid, "POST", "/vjJng1E7cT0TFdiE00DJ", [], body)
    
  end
end