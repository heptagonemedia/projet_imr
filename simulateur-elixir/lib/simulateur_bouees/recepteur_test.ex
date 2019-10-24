defmodule SimulateurBouees.RecepteurTest do
  use GenServer
  
  def start_link do
    ip = Application.get_env :gen_tcp, :ip, {127,0,0,1}
    port = Application.get_env :gen_tcp, :port, 6379
    GenServer.start_link(__MODULE__, [ip, port], [])
  end

  def init [ip, port] do
    {:ok,listen_socket} = :gen_tcp.listen(port,[:binary,{:packet, 0},{:active,true},{:ip,ip}])
    case :gen_tcp.accept listen_socket do
      {:ok,socket } -> {:ok, %{ip: ip, port: port, socket: socket}}
      {:error, :einval} -> {:error, :einval}
    end 

  end

  def handle_info({:tcp,socket,packet},state) do
    IO.inspect packet, label: "Paquet recu: "
    :gen_tcp.send socket,"recv"
    {:noreply,state}
  end   

  def handle_info({:tcp_closed,socket},state) do
    IO.inspect "Le socket est fermé."
    {:noreply,state}
  end   

  def handle_info({:tcp_error,socket,reason},state) do
    IO.inspect socket,label: "Connexion terminée pour la raison : #{reason}"
    {:noreply,state}
  end
end