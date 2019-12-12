defmodule RecepteurWeb.DonneeController do
  use RecepteurWeb, :controller

  alias Recepteur.Donnees
  alias Recepteur.Donnees.Donnee

  action_fallback RecepteurWeb.FallbackController

  def index(conn, _params) do
    donnee = Donnees.list_donnee()
    render(conn, "index.json", donnee: donnee)
  end

  def create(conn, %{"donnee" => donnee_params}) do
    with {:ok, %Donnee{} = donnee} <- Donnees.create_donnee(donnee_params) do
      conn
      |> put_status(:created)
      |> put_resp_header("location", Routes.donnee_path(conn, :show, donnee))
      |> render("show.json", donnee: donnee)
    end
  end

  def show(conn, %{"id" => id}) do
    donnee = Donnees.get_donnee!(id)
    render(conn, "show.json", donnee: donnee)
  end

  def update(conn, %{"id" => id, "donnee" => donnee_params}) do
    donnee = Donnees.get_donnee!(id)

    with {:ok, %Donnee{} = donnee} <- Donnees.update_donnee(donnee, donnee_params) do
      render(conn, "show.json", donnee: donnee)
    end
  end

  def delete(conn, %{"id" => id}) do
    donnee = Donnees.get_donnee!(id)

    with {:ok, %Donnee{}} <- Donnees.delete_donnee(donnee) do
      send_resp(conn, :no_content, "")
    end
  end
end
