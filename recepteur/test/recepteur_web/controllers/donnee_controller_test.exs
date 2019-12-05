defmodule RecepteurWeb.DonneeControllerTest do
  use RecepteurWeb.ConnCase

  alias Recepteur.Reception
  alias Recepteur.Reception.Donnee

  @create_attrs %{

  }
  @update_attrs %{

  }
  @invalid_attrs %{}

  def fixture(:donnee) do
    {:ok, donnee} = Reception.create_donnee(@create_attrs)
    donnee
  end

  setup %{conn: conn} do
    {:ok, conn: put_req_header(conn, "accept", "application/json")}
  end

  describe "index" do
    test "lists all donnee", %{conn: conn} do
      conn = get(conn, Routes.donnee_path(conn, :index))
      assert json_response(conn, 200)["data"] == []
    end
  end

  describe "create donnee" do
    test "renders donnee when data is valid", %{conn: conn} do
      conn = post(conn, Routes.donnee_path(conn, :create), donnee: @create_attrs)
      assert %{"id" => id} = json_response(conn, 201)["data"]

      conn = get(conn, Routes.donnee_path(conn, :show, id))

      assert %{
               "id" => id
             } = json_response(conn, 200)["data"]
    end

    test "renders errors when data is invalid", %{conn: conn} do
      conn = post(conn, Routes.donnee_path(conn, :create), donnee: @invalid_attrs)
      assert json_response(conn, 422)["errors"] != %{}
    end
  end

  describe "update donnee" do
    setup [:create_donnee]

    test "renders donnee when data is valid", %{conn: conn, donnee: %Donnee{id: id} = donnee} do
      conn = put(conn, Routes.donnee_path(conn, :update, donnee), donnee: @update_attrs)
      assert %{"id" => ^id} = json_response(conn, 200)["data"]

      conn = get(conn, Routes.donnee_path(conn, :show, id))

      assert %{
               "id" => id
             } = json_response(conn, 200)["data"]
    end

    test "renders errors when data is invalid", %{conn: conn, donnee: donnee} do
      conn = put(conn, Routes.donnee_path(conn, :update, donnee), donnee: @invalid_attrs)
      assert json_response(conn, 422)["errors"] != %{}
    end
  end

  describe "delete donnee" do
    setup [:create_donnee]

    test "deletes chosen donnee", %{conn: conn, donnee: donnee} do
      conn = delete(conn, Routes.donnee_path(conn, :delete, donnee))
      assert response(conn, 204)

      assert_error_sent 404, fn ->
        get(conn, Routes.donnee_path(conn, :show, donnee))
      end
    end
  end

  defp create_donnee(_) do
    donnee = fixture(:donnee)
    {:ok, donnee: donnee}
  end
end
