defmodule Receiver do

  def process_data(client, data) do
    send client, :received
    insert(data)
  end

  def show(input) do
    IO.puts input
  end

  def insert(data) do
    {{annee, mois, jour}, {heure, minute, seconde}} = data.timestamp
    IO.inspect annee <> "-" <> mois <> "-" <> jour <> " " <> heure <> ":" <> minute <> ":" <> seconde

    

    #donnee = %Receiver.Donnee{id_bouee: data.id_bouee,temperature: data.temperature,debit: data.debit,salinite: data.salinite,longitude: data.longitude,latitude: data.latitude,batterie: data.batterie,timestamp: datetime }

    #Receiver.Repo.insert(donnee)
  end
end
