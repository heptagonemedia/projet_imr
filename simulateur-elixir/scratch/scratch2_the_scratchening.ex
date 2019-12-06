field :id_bouee, :id
field :longitude_reelle, :float
field :latitude_reelle, :float
field :date_saisie, :utc_datetime
field :batterie, :integer

field :temperature, :float
field :salinite, :float
field :debit, :float


field :erreur_temperature, :decimal
field :erreur_debit, :decimal
field :erreur_salinite, :decimal
field :erreur_longitude, :decimal
field :erreur_latitude, :decimal
field :valeur_decrementation_batterie, :integer
field :valeur_depart_temperature, :decimal
field :valeur_depart_debit, :decimal
field :valeur_depart_salinite, :decimal
field :prendre_compte, :boolean