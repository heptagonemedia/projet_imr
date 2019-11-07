defmodule SimulateurBouees.BoueeGen do
  use Agent

  def start_link(initial) do
    init(initial)
    Agent.start_link(process(%{}))
  end

  def init(initial) do
    state = %{id_bouee: initial.idbouee, scenario: initial.scenario}
    temperature = Enum.random(5..10)
    salinite = Enum.random(5..10)
    debit = Enum.random(5..10)
    valeurs_initiales = %{temperature: temperature, salinite: salinite, debit: debit}
    latitude = :rand.uniform(20)
    longitude = :rand.uniform(20)
    batterie = 100
    valeurs_initiales = %{valeurs_initiales | longitude: longitude, latitude: latitude, batterie: batterie}
    state = %{state | valeurs_initiales: valeurs_initiales}
  end

  def process(state) do
    receive do
      after
        1_000 ->
          generer(state)
          process(state)
    end
  end

  def generer(state) do
    if state.dernieres_valeurs do
      # Si il existe des dernieres valeurs 
      # temperature = state.dernieres_valeurs.temperature + #GestionnaireScenario.GetRandomValue(id, value)
      # salinite = state.dernieres_valeurs.salinite + #GestionnaireScenario.GetRandomValue(id, value)
      # debit = state.dernieres_valeurs.debit + #GestionnaireScenario.GetRandomValue(id, value)
      # valeurs_initiales = %{temperature: temperature, salinite: salinite, debit: debit}
      latitude = :rand.uniform(20)
      longitude = :rand.uniform(20)
      batterie = 100
    else
      # Si il n'existe aucune dernieres valeurs 

    end
    # SimulateurBouees.Concentrateur.put()
  end
end