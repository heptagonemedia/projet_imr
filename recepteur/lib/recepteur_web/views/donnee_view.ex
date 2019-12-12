defmodule RecepteurWeb.DonneeView do
  use RecepteurWeb, :view
  alias RecepteurWeb.DonneeView

  def render("index.json", %{donnee: donnee}) do
    %{data: render_many(donnee, DonneeView, "donnee.json")}
  end

  def render("show.json", %{donnee: donnee}) do
    %{data: render_one(donnee, DonneeView, "donnee.json")}
  end

  def render("donnee.json", %{donnee: donnee}) do
    %{id: donnee.id,
      id_bouee: donnee.id_bouee,
      longitude_reelle: donnee.longitude_reelle,
      latitude_reelle: donnee.latitude_reelle,
      date_saisie: donnee.date_saisie,
      batterie: donnee.batterie,
      temperature: donnee.temperature,
      salinite: donnee.salinite,
      debit: donnee.debit}
  end
end
