defmodule RecepteurWeb.DonneeController do
  use RecepteurWeb, :controller

  alias Recepteur.Reception
  alias Recepteur.Reception.Donnee

  action_fallback RecepteurWeb.FallbackController

  def index(conn, _params) do
    donnee = Reception.list_donnee()
    render(conn, "index.json", donnee: donnee)
  end

  def create(conn, %{"donnee" => donnee_params}) do
    with {:ok, %Donnee{} = donnee} <- Reception.create_donnee(donnee_params) do
      conn
      |> put_status(:created)
      |> put_resp_header("location", Routes.donnee_path(conn, :show, donnee))
      |> render("show.json", donnee: donnee)
    end
  end

  def show(conn, %{"id" => id}) do
    donnee = Reception.get_donnee!(id)
    render(conn, "show.json", donnee: donnee)
  end

  def update(conn, %{"id" => id, "donnee" => donnee_params}) do
    donnee = Reception.get_donnee!(id)

    with {:ok, %Donnee{} = donnee} <- Reception.update_donnee(donnee, donnee_params) do
      render(conn, "show.json", donnee: donnee)
    end
  end

  def delete(conn, %{"id" => id}) do
    donnee = Reception.get_donnee!(id)

    with {:ok, %Donnee{}} <- Reception.delete_donnee(donnee) do
      send_resp(conn, :no_content, "")
    end
  end
end
