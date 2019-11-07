package com.heptagonemedia;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;

public class Main {

    public static void main(String[] args) throws IOException {
	String str = "";

        for(int x = 0; x <= 600; x++){
            for(int y = 0; y <= 50 ; y++){
                str +=  "%SimulateurBouees.Scenario{id_scenario: "+y+", id_delta: "+x+", temperature: 0, debit: 0, salinite: 0, longitude: 0.0, latitude: 0.0, batterie: 0},";

            }
        }

    BufferedWriter writer = new BufferedWriter(new FileWriter("list.exs"));
    writer.write(str);

    writer.close();

    }
}
