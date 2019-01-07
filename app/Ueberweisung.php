<?php

namespace App;

use App\Http\Controllers\PdfGenerate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Ueberweisung extends Model
{
    //ist so konfiguriert, dass es nur unter LINUX funktioniert!!!!!!!!
    public function doUebereweisung()
    {
        $meinKonto = DB::table('einrichtung')->first();
        $input = Input::get();
        $datum = new \DateTime();
        $i = 1;

        unset($input["_token"]);    //token muss weg, damit fehlerfrei gelooped wird
        foreach ($input as $item) {
            //hier noch: nur berücksichtigen, wenn auch ausgewählt
            if (!isset($item['erstellen'])) {
               continue;
            }

            //betrag berechnen
            $betrag = 0;

            //wenn eigener betrag eingegeben wurde wird dieser verwendet
            if (isset($item['eigenerBetrag']) && $item['eigenerBetrag'] != "") {
                $betrag = $item['eigenerBetrag'];
            }
            //ansonsten: automatische berechnung aus alter + awg-wiGeld
            else {
                if (isset($item['aussenwohnung']) && $item['aussenwohnung'] == "on") {
                    $betrag = $betrag + 90; //180 euro WiGeld f�r AWG-Bewohner pro Monat
                }
                //taschengeldsatz f�r monat dazuz�hlen
                $betrag = $betrag + $item['taschengeld']/2;
            }

            //auf 2 Nachkommastellen runden
            $betrag = round($betrag, 2);

            //das DE von der Kontonummer wegmachen
            $eigenesKonto = substr($meinKonto->konto_iban, 2);
            //name erzeugen
            $name = $item['name'] . ", " . $item['vorname'];

            $data = [
                'Zahlungsempf�nger' => $name,
                'Angaben zum Kontoinhaber' => $meinKonto->konto_bezeichnung,
                'Datum' => $datum->format('d.m.Y'),
                'Verwendungszweck' => $item['betreff'], //hier noch l�nge kontrollieren
                'noch Verwendungszweck' => '',
                'Betrag Euro Cent' => $betrag,
                'Kreditinstitut' => $meinKonto->konto_bezeichnung,
                'BIC Kreditinstitut' => '',
                'IBAN des Kontoinhabers' => $item['iban'],
                'BIC' => '',
                'IBAN' => $eigenesKonto
            ];

            $myFile = public_path() . "/modul_ueberweisung/SEPA_Formular.pdf";

            $pdf = new PdfGenerate($myFile, $data);
            $pdf->flatten()->save(public_path() . "/modul_ueberweisung/temp/output" . $i++ . ".pdf");
        }

        // alles zusammenf�gen
        $command = "pdftk \"" . public_path() . "/modul_ueberweisung/temp/*.pdf\" cat output \"" . public_path() . "/modul_ueberweisung/output.pdf\"";
        exec($command);

        // das temp-verzeichnis danach wieder aufr�umen
        $fullPath = public_path() . "/modul_ueberweisung/temp/" ;
        array_map('unlink', glob( "$fullPath*.pdf"));

        // und herunterladen
        if (isset($pdf)) {
            $pdf->setOutput(public_path() . "/modul_ueberweisung/output.pdf");
            $pdf->download();
        }
    }
}
