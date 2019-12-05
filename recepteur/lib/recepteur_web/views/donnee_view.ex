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
    %{id: donnee.id}
  end
end
