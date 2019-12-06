
{:ok, conn} = Mint.HTTP.connect(_scheme = :https, _host = "putsreq.com", _port = 443)
data = %{:id_bouee => 1, :latitude => 1, :longitude => 1, :timestamp => 1, :batterie => 1, :temperature => 1, :salinite => 1, :debit => 1}
{response, body} = Poison.encode(data)
{:ok, conn, request_ref} = Mint.HTTP.request(conn, _method = "PUT", _path = "/vjJng1E7cT0TFdiE00DJ", _headers = [], body)