efmodule TcpUsage do
  use GenServer

  defmodule State do
    defstruct socket: nil
  end

  def start_link, do: GenServer.start_link(__MODULE__, [])

  def init(_) do
    # try to open connection in 100ms, this could be a send or cast
    Process.send_after(self, :connect, 100)

    {:ok, %State{}}
  end

  def handle_info(:connect, %State{socket: nil} = state) do
    {:noreply, connect(state)}
  end   

  def handle_call({:recv, bytes, timeout}, _, state) do 
    case :gen_tcp.recv(state.socket, bytes, timeout) do
      {:ok, _} = ok ->
        {:reply, ok, state}
      {:error, :timeout} = timeout ->
        {:reply, timeout, state}
      {:error, _} = error ->
        {:reply, error, state}
    end
  end   

  defp connect(state) do
    opts = [:binary, packet: :line, active: false, reuseaddr: true, keepalive: true]
    # I would try to move these to your config, and pass them as args into the genserver,
    # Or load them from here with Application.get_env
    case :gen_tcp.connect('10.10.10.10', 1000, opts) do
      {:ok, socket} ->
        %{state| socket: socket}
      {:error, _} ->
        Process.send_after(self(), :connect, 5_000) # maybe do some backoff here, get the wait time from a function
        state
    end
  end
end
