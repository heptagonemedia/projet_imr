defmodule Recepteur.Extracteur do
  def extraire(map) do
    map
    |> extraire_historique_donnee_bouee()
    |> extraire_mesure()
  end

  def extraire_historique_donnee_bouee(map) do
    _donnee_traitee = %{map: map, historique_donnee_bouee: %Recepteur.HistoriqueDonneeBouee{date_saisie: map.date_saisie, longitude_reelle: map.longitude_reelle, latitude_reelle: map.latitude_reelle, batterie: map.batterie, id_bouee: map.id_bouee}}
  end

  def extraire_mesure() do
    temperature = %Recepteur.Mesure{}
  end
end
