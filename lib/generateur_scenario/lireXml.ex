defmodule GenerateurScenario.LireXml do


    def get_nom_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/nom/text()"l)
    end

    def get_temperature_la_plus_basse() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/temperature/temperature_la_plus_basse/text()"l)
    end

    def get_temperature_la_plus_haute() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/temperature/temperature_la_plus_haute/text()"l)
    end

    def convertir_temperature_map do
        %{min: GenerateurScenario.LireXml.get_temperature_la_plus_basse ,
      max: GenerateurScenario.LireXml.get_temperature_la_plus_haute};
    end

    def get_salinite_la_plus_basse() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/salinite/salinite_la_plus_basse/text()"l)
    end

    def get_salinite_la_plus_haute() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/salinite/salinite_la_plus_haute/text()"l)
    end

    def convertir_salinite_map do
        %{min: GenerateurScenario.LireXml.get_salinite_la_plus_basse ,
      max: GenerateurScenario.LireXml.get_salinite_la_plus_haute};
    end

    def get_debit_le_plus_bas() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/debit/debit_le_plus_bas/text()"l)
    end

    def get_debit_le_plus_haut() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/debit/debit_le_plus_haut/text()"l)
    end

    def convertir_debit_map do
        %{min: GenerateurScenario.LireXml.get_debit_le_plus_bas ,
      max: GenerateurScenario.LireXml.get_debit_le_plus_haut};
    end

    def get_scenario_base() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioBase/text()"l)
    end

    def get_nb_scenario() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/nbScenario/text()"l)
    end

    def get_scenario_normaux() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioNormaux/text()"l)
    end

    def get_scenario_hybride() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioHybride/text()"l)
    end

    def get_scenario_retarde() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioRetardes/text()"l)
    end

end