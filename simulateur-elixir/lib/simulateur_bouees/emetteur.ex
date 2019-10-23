defmodule SimulateurBouees.Emetteur do
    use GenServer
    
    def start_link do
      GenServer.start_link(__MODULE__, @initial_state)
    end
  
    def init(state) do
      opts = [:binary, active: false]
      {:ok, socket} = :gen_tcp.connect('127.0.0.1', 6379, opts)
      {:ok, %{state | socket: socket}}
    end

    def command(pid, cmd) do
      GenServer.call(pid, {:command, cmd})
    end
  
    def handle_call({:command, cmd}, from, %{socket: socket} = state) do
      :ok = :gen_tcp.send(socket, encode(cmd))
  
      # `0` means receive all available bytes on the socket.
      {:ok, msg} = :gen_tcp.recv(socket, 0)
      {:reply, decode(msg), state}
    end

    def encode(msg) do
      msg
    end

    def decode(msg) do
      msg
    end
  end