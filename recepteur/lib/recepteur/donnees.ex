defmodule Recepteur.Donnees do
  @moduledoc """
  The Donnees context.
  """

  import Ecto.Query, warn: false
  alias Recepteur.Repo

  alias Recepteur.Donnees.Donnee

  @doc """
  Returns the list of donnee.

  ## Examples

      iex> list_donnee()
      [%Donnee{}, ...]

  """
  def list_donnee do
    Repo.all(Donnee)
  end

  @doc """
  Gets a single donnee.

  Raises `Ecto.NoResultsError` if the Donnee does not exist.

  ## Examples

      iex> get_donnee!(123)
      %Donnee{}

      iex> get_donnee!(456)
      ** (Ecto.NoResultsError)

  """
  def get_donnee!(id), do: Repo.get!(Donnee, id)

  @doc """
  Creates a donnee.

  ## Examples

      iex> create_donnee(%{field: value})
      {:ok, %Donnee{}}

      iex> create_donnee(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_donnee(attrs \\ %{}) do
    %Donnee{}
    |> Donnee.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a donnee.

  ## Examples

      iex> update_donnee(donnee, %{field: new_value})
      {:ok, %Donnee{}}

      iex> update_donnee(donnee, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_donnee(%Donnee{} = donnee, attrs) do
    donnee
    |> Donnee.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a Donnee.

  ## Examples

      iex> delete_donnee(donnee)
      {:ok, %Donnee{}}

      iex> delete_donnee(donnee)
      {:error, %Ecto.Changeset{}}

  """
  def delete_donnee(%Donnee{} = donnee) do
    Repo.delete(donnee)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking donnee changes.

  ## Examples

      iex> change_donnee(donnee)
      %Ecto.Changeset{source: %Donnee{}}

  """
  def change_donnee(%Donnee{} = donnee) do
    Donnee.changeset(donnee, %{})
  end
end
