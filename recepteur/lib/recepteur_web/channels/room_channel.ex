defmodule RecepteurWeb.RoomChannel do
  use RecepteurWeb, :channel

  def join("room:lobby", _message, socket) do
    {:ok, socket}
  end

  def join("room:" <> _private_room_id, _params, _socket) do
    {:error, %{reason: "unauthorized"}}
  end

  def handle_in("new_msg", %{"body" => body}, socket) do
    broadcast!(socket, "new_msg", %{body: body})
    #test = Poison.decode!(body, as: %Recepteur.Region{})
    #IO.puts test.etiquette
    IO.puts body
    testRegion = Poison.decode!(body, as: %Recepteur.Region{}) # {"etiquette": "Ocean Antartique"}
    int = elem(Recepteur.Repo.insert(testRegion), 1)
    IO.puts int.id_region

    {:noreply, socket}
  end
end
