defmodule Recepteur.DonneesTest do
  use Recepteur.DataCase

  alias Recepteur.Donnees

  describe "donnee" do
    alias Recepteur.Donnees.Donnee

    @valid_attrs %{batterie: 42, date_saisie: "2010-04-17T14:00:00Z", debit: 120.5, id_bouee: 42, latitude_reelle: 120.5, longitude_reelle: 120.5, salinite: 120.5, temperature: 120.5}
    @update_attrs %{batterie: 43, date_saisie: "2011-05-18T15:01:01Z", debit: 456.7, id_bouee: 43, latitude_reelle: 456.7, longitude_reelle: 456.7, salinite: 456.7, temperature: 456.7}
    @invalid_attrs %{batterie: nil, date_saisie: nil, debit: nil, id_bouee: nil, latitude_reelle: nil, longitude_reelle: nil, salinite: nil, temperature: nil}

    def donnee_fixture(attrs \\ %{}) do
      {:ok, donnee} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Donnees.create_donnee()

      donnee
    end

    test "list_donnee/0 returns all donnee" do
      donnee = donnee_fixture()
      assert Donnees.list_donnee() == [donnee]
    end

    test "get_donnee!/1 returns the donnee with given id" do
      donnee = donnee_fixture()
      assert Donnees.get_donnee!(donnee.id) == donnee
    end

    test "create_donnee/1 with valid data creates a donnee" do
      assert {:ok, %Donnee{} = donnee} = Donnees.create_donnee(@valid_attrs)
      assert donnee.batterie == 42
      assert donnee.date_saisie == DateTime.from_naive!(~N[2010-04-17T14:00:00Z], "Etc/UTC")
      assert donnee.debit == 120.5
      assert donnee.id_bouee == 42
      assert donnee.latitude_reelle == 120.5
      assert donnee.longitude_reelle == 120.5
      assert donnee.salinite == 120.5
      assert donnee.temperature == 120.5
    end

    test "create_donnee/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Donnees.create_donnee(@invalid_attrs)
    end

    test "update_donnee/2 with valid data updates the donnee" do
      donnee = donnee_fixture()
      assert {:ok, %Donnee{} = donnee} = Donnees.update_donnee(donnee, @update_attrs)
      assert donnee.batterie == 43
      assert donnee.date_saisie == DateTime.from_naive!(~N[2011-05-18T15:01:01Z], "Etc/UTC")
      assert donnee.debit == 456.7
      assert donnee.id_bouee == 43
      assert donnee.latitude_reelle == 456.7
      assert donnee.longitude_reelle == 456.7
      assert donnee.salinite == 456.7
      assert donnee.temperature == 456.7
    end

    test "update_donnee/2 with invalid data returns error changeset" do
      donnee = donnee_fixture()
      assert {:error, %Ecto.Changeset{}} = Donnees.update_donnee(donnee, @invalid_attrs)
      assert donnee == Donnees.get_donnee!(donnee.id)
    end

    test "delete_donnee/1 deletes the donnee" do
      donnee = donnee_fixture()
      assert {:ok, %Donnee{}} = Donnees.delete_donnee(donnee)
      assert_raise Ecto.NoResultsError, fn -> Donnees.get_donnee!(donnee.id) end
    end

    test "change_donnee/1 returns a donnee changeset" do
      donnee = donnee_fixture()
      assert %Ecto.Changeset{} = Donnees.change_donnee(donnee)
    end
  end
end
