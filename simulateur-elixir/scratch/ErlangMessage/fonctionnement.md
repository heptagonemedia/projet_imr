Fonctionnement:

1- Ouvrir un shell dans chaque dossier: recv, emit
2- Démarrer IEx dans chaque shell avec un nom :

iex --name emit@10.1.106.10 -S mix
iex --name recv@10.1.38.24 -S mix

3- Dans le shell emit, envoyer des requêtes avec la syntaxe suivante:
Specific example::

:rpc.call(:"recv@10.1.38.24", Receiver, :process_data, [self(), %{data: 2}])

Generic example::

:rpc.call(:"<<Nom IEx>>@<<Hostname>>", <Module>, :<<fonction>>, [PID, %{<<Données>>}])

4- Le IEx qui tourne Receiver va recevoir les messages et répondre :received 
5- Faire flush() sur Emitter pour voir :received et confirmer la transaction.