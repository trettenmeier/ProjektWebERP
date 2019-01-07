<?php

namespace App\Http\Controllers;

use App\Ueberweisung;
use Illuminate\Support\Facades\DB;

class KlientenController extends Controller
{

    /**
     * @return $this
     */
    public function index()
    {
        $data = DB::table('klienten')
            ->where('active', 'Y')
            ->orWhere('active', 'y')
            ->get();

        //daten aufbereiten
        foreach ($data as $eintrag) {
            if ($eintrag->aufgenommen_am == "") {
                $eintrag->aufgenommen_am = "Nicht angegeben";
            }

            if ($eintrag->aussenwohnung == "y" || $eintrag->aussenwohnung == "Y") {
                $eintrag->aussenwohnung = "Außenwohnung";
            } elseif ($eintrag->aussenwohnung == "n" || $eintrag->aussenwohnung == "N") {
                $eintrag->aussenwohnung = "In der WG";
            } else $eintrag->aussenwohung = "Nicht angegeben";

            if ($eintrag->fallverantwortlich == "") {
                $eintrag->fallverantwortlich = "Nicht angegeben";
            }

            if ($eintrag->geburtsdatum == "") {
                $eintrag->geburtsdatum = "Nicht angegeben";
            } else {
                $temp = new \DateTime($eintrag->geburtsdatum);
                $eintrag->geburtsdatum = $temp->format('d-M-Y');
            }
        }

        return view('klienten/klientenIndex')
            ->with('data', $data);
    }

    public function create()
    {
        return view('klienten/klientenCreate');
    }

    public function doCreate()
    {
        //noch prüfen, ob die daten ok sind
        $array = [
            'vorname' => $_POST['vorname'],
            'name' => $_POST['name'],
            'geburtsdatum' => $_POST['geburtsdatum'],
            'geschlecht' => $_POST['geschlecht'],
        ];

        if ($_POST['aussenwohnung'] != "")
            $array['aussenwohnung'] = $_POST['aussenwohnung'];

        if ($_POST['aufnahme'] != "")
            $array['aufgenommen_am'] = $_POST['aufnahme'];

        if ($_POST['entlassen'] != "")
            $array['entlassen_am'] = $_POST['entlassen'];

        if ($_POST['active'] == 'y' || $_POST['active'] == 'Y' || $_POST['active'] == 'n' || $_POST['active'] == 'N')
            $array['active'] = $_POST['active'];

        if ($_POST['fallverantwortlich'] != "")
            $array['fallverantwortlich'] = $_POST['fallverantwortlich'];

        if ($_POST['bz'] != "")
            $array['beratungszentrum'] = $_POST['bz'];

        if ($_POST['wjh'] != "")
            $array['wirtsch_juhi'] = $_POST['wjh'];

        if ($_POST['buchungszeichen_kb'] != "")
            $array['buchungszeichen_kostenbeitrag'] = $_POST['buchungszeichen_kb'];

        if ($_POST['schule-ag'] != "")
            $array['schule_ag'] = $_POST['schule-ag'];

        if ($_POST['angestr_abschluss'] != "")
            $array['angestr_abschluss'] = $_POST['angestr_abschluss'];

        if ($_POST['ansprechpartner1_name'] != "")
            $array['ansprechpartner1_name'] = $_POST['ansprechpartner1_name'];

        if ($_POST['ansprechpartner1_tel'] != "")
            $array['ansprechpartner1_tel'] = $_POST['ansprechpartner1_tel'];

        if ($_POST['ansprechpartner1_email'] != "")
            $array['ansprechpartner1_email'] = $_POST['ansprechpartner1_email'];

        if ($_POST['ansprechpartner2_name'] != "")
            $array['ansprechpartner2_name'] = $_POST['ansprechpartner2_name'];

        if ($_POST['ansprechpartner2_tel'] != "")
            $array['ansprechpartner2_tel'] = $_POST['ansprechpartner2_tel'];

        if ($_POST['ansprechpartner2_email'] != "")
            $array['ansprechpartner2_email'] = $_POST['ansprechpartner2_email'];

        if ($_POST['iban'] != "")
            $array['konto_iban'] = $_POST['iban'];


        //insert - id ist die id in der klienten-tabelle
        $id = DB::table('klienten')->insertGetId($array);

        $target = '/klient/show/' . $id;
        return redirect($target);

    }

    public function show($id)
    {
        $data = DB::table('klienten')->where('id', $id)->first();

        return view('klienten/KlientenShow')
            ->with('data', $data);
    }

    public function edit($id)
    {
        $data = DB::table('klienten')->where('id', $id)->first();

        return view('klienten/klientenEdit')
            ->with('data', $data);
    }

    public function doEdit()
    {
        $array = [
            'vorname' => $_POST['vorname'],
            'name' => $_POST['name'],
            'geburtsdatum' => $_POST['geburtsdatum'],
            'geschlecht' => $_POST['geschlecht'],
        ];

        $array['aussenwohnung'] = $_POST['aussenwohnung'];

        if ($_POST['aufnahme'] == "") {
            $array['aufgenommen_am'] = "1970-01-01";
        }
        else {
            $array['aufgenommen_am'] = $_POST['aufnahme'];
        }

        if ($_POST['entlassen'] == "") {
            $array['entlassen_am'] = "1970-01-01";
        }
        else {
            $array['entlassen_am'] = $_POST['entlassen'];
        }


        $array['active'] = $_POST['active'];
        $array['fallverantwortlich'] = $_POST['fallverantwortlich'];
        $array['beratungszentrum'] = $_POST['bz'];
        $array['wirtsch_juhi'] = $_POST['wjh'];
        $array['buchungszeichen_kostenbeitrag'] = $_POST['buchungszeichen_kb'];
        $array['schule_ag'] = $_POST['schule-ag'];
        $array['angestr_abschluss'] = $_POST['angestr_abschluss'];
        $array['ansprechpartner1_name'] = $_POST['ansprechpartner1_name'];
        $array['ansprechpartner1_tel'] = $_POST['ansprechpartner1_tel'];
        $array['ansprechpartner1_email'] = $_POST['ansprechpartner1_email'];
        $array['ansprechpartner2_name'] = $_POST['ansprechpartner2_name'];
        $array['ansprechpartner2_tel'] = $_POST['ansprechpartner2_tel'];
        $array['ansprechpartner2_email'] = $_POST['ansprechpartner2_email'];
        $array['konto_iban'] = $_POST['iban'];


        DB::table('klienten')
            ->where('id', $_POST['id'])
            ->update($array);

        $target = '/klient/show/' . $_POST['id'];
        return redirect($target);
    }

    public function ueberweisungScreen()
    {
        $data = DB::table('klienten_view')
            ->where('active', 'y')
            ->get();

        $tg_saetze = DB::table('taschengeld')->get();
        $tg_stufen = [];
        foreach ($tg_saetze as $item) {
            $tg_stufen[$item->id] = $item->wert;
        }

        //taschengeld berechnen anhand des alters!
        foreach ($data as $eintrag) {
            $age= date_diff(date_create($eintrag->geburtsdatum), date_create('today'))->y;
            if ($age < 16)               $eintrag->taschengeld = $tg_stufen[0];
            if ($age >= 16 && $age < 18) $eintrag->taschengeld = $tg_stufen[1];
            if ($age >= 18)              $eintrag->taschengeld = $tg_stufen[2];
        }

        return view('klienten/ueberweisungScreen')
            ->with('data', $data);
    }

    public function doUeberweisung()
    {
        // ausgelagert in das model
        $object = new Ueberweisung();
        $object->doUebereweisung();

    }
}
