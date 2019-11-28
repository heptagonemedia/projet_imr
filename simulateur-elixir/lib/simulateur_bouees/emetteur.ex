defmodule SimulateurBouees.Emetteur do
    use GenServer
    
    defmodule State do
      defstruct socket: nil
    end

    def start_link(transport) do
      GenServer.start_link(__MODULE__, transport)
    end

    def handle_info(:connect, %State{socket: nil} = state) do
      {:noreply, connect(state)}
    end

    defp connect(state) do
      opts = [:binary, packet: 0, active: false, reuseaddr: true, keepalive: true]
      ip = Application.get_env :gen_tcp, :ip, {127,0,0,1}
      port = Application.get_env :gen_tcp, :port, 6379
      case :gen_tcp.connect(ip, port, opts) do
        {:ok, socket} ->
          %{state| socket: socket}
        {:error, _} ->
          Process.send_after(self(), :connect, 5_000) # maybe do some backoff here, get the wait time from a function
          state
      end
    end

    def command(pid, cmd) do
      GenServer.call(pid, {:command, cmd})
    end
  
    def handle_call({:command, cmd}, _from, %{socket: socket} = state) do
      :ok = :gen_tcp.send(socket, encode(cmd))
  
      # `0` means receive all available bytes on the socket.
      {:ok, msg} = :gen_tcp.recv(socket, 0)
      {:reply, decode(msg), state}
    end

    def handle_call({:connect, cmd}, _from, %{socket: socket} = state) do
      :ok = :gen_tcp.send(socket, encode(cmd))
  
      # `0` means receive all available bytes on the socket.
      {:ok, msg} = :gen_tcp.recv(socket, 0)
      {:reply, decode(msg), state}
    end

    def sendData(data) do
      GenServer.call(:ok, data)
    end

    def encode(msg) do
      msg
    end

    def decode(msg) do
      msg
    end
  end