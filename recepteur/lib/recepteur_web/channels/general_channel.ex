defmodule RecepteurWeb.GeneralChannel do
  use RecepteurWeb, :channel

  def join("general", _message, socket) do
    {:ok, socket}
  end

  def join("general:" <> _private_room_id, _params, _socket) do
    {:error, %{reason: "unauthorized"}}
  end

  def handle_in("new_msg", %{"body" => body}, socket) do
    broadcast!(socket, "new_msg", %{body: body})

    # {"id_bouee": 1, "longitude_reelle": 50.0, "latitude_reelle": 340.0}

    IO.puts body
    donnee = Poison.decode!(body, as: %Recepteur.Donnee{})

    Recepteur.Repo.insert(donnee)

    {:noreply, socket}
  end
end
