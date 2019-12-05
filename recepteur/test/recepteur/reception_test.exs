defmodule Recepteur.ReceptionTest do
  use Recepteur.DataCase

  alias Recepteur.Reception

  describe "donnee" do
    alias Recepteur.Reception.Donnee

    @valid_attrs %{}
    @update_attrs %{}
    @invalid_attrs %{}

    def donnee_fixture(attrs \\ %{}) do
      {:ok, donnee} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Reception.create_donnee()

      donnee
    end

    test "list_donnee/0 returns all donnee" do
      donnee = donnee_fixture()
      assert Reception.list_donnee() == [donnee]
    end

    test "get_donnee!/1 returns the donnee with given id" do
      donnee = donnee_fixture()
      assert Reception.get_donnee!(donnee.id) == donnee
    end

    test "create_donnee/1 with valid data creates a donnee" do
      assert {:ok, %Donnee{} = donnee} = Reception.create_donnee(@valid_attrs)
    end

    test "create_donnee/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Reception.create_donnee(@invalid_attrs)
    end

    test "update_donnee/2 with valid data updates the donnee" do
      donnee = donnee_fixture()
      assert {:ok, %Donnee{} = donnee} = Reception.update_donnee(donnee, @update_attrs)
    end

    test "update_donnee/2 with invalid data returns error changeset" do
      donnee = donnee_fixture()
      assert {:error, %Ecto.Changeset{}} = Reception.update_donnee(donnee, @invalid_attrs)
      assert donnee == Reception.get_donnee!(donnee.id)
    end

    test "delete_donnee/1 deletes the donnee" do
      donnee = donnee_fixture()
      assert {:ok, %Donnee{}} = Reception.delete_donnee(donnee)
      assert_raise Ecto.NoResultsError, fn -> Reception.get_donnee!(donnee.id) end
    end

    test "change_donnee/1 returns a donnee changeset" do
      donnee = donnee_fixture()
      assert %Ecto.Changeset{} = Reception.change_donnee(donnee)
    end
  end
end
