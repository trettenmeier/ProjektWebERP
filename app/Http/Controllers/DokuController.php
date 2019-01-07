<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokuController extends Controller
{
    /**
     * Hauptseite, wenn zur Dokumentation navigiert wird.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //klienten_id ist dann null
        $klienten_id = 0;

        $startDatum = new \DateTime();
        $endDatum = new \DateTime();
        $startDatum->modify('-3 month');

        //daten für die inhalte
        $data = DB::table('dokumentation_view')
            ->where('klient_id', '0')
            ->whereDate('datum', '>=', $startDatum->format('Y-m-d' . ' 00:00:00'))
            ->whereDate('datum', '<=', $endDatum->format('Y-m-d' . ' 23:59:59'))
            ->orderBy('datum', 'desc')
            ->get();

        //liste für das menü
        $liste = DB::table('klienten_view')
            ->where('active', 'Y')
            ->orderBy('vorname', 'asc')
            ->get();

        return view('doku/dokuIndex')
            ->with('data', $data)
            ->with('liste', $liste)
            ->with('klienten_id', $klienten_id)
            ->with('startDatum', $startDatum->format('d-m-Y'))
            ->with('endDatum', $endDatum->format('d-m-Y'));
    }


    public function klient($klienten_id)
    {
        //prüfen, ob ein datum mitgegeben wurde ansonsten heutiges Datum -3 Monate
        if (isset($_POST['startDatum'])) {
            if ($_POST['startDatum'] != "") {
                $startDatum = \DateTime::createFromFormat('d-m-Y', $_POST['startDatum']);
            } else {
                $startDatum = new \DateTime();
                $startDatum->modify('-3 month');
            }
        } else {
            $startDatum = new \DateTime();
            $startDatum->modify('-3 month');
        }

        //nochmal für das enddatum
        if (isset($_POST['endDatum'])) {
            if ($_POST['endDatum'] != "") {
                $endDatum = \DateTime::createFromFormat('d-m-Y', $_POST['endDatum']);
            } else {
                $endDatum = new \DateTime();
            }
        } else {
            $endDatum = new \DateTime();
        }

        $data = DB::table('dokumentation_view')
            ->where('klient_id', $klienten_id)
            ->whereDate('datum', '>=', $startDatum->format('Y-m-d' . ' 00:00:00'))
            ->whereDate('datum', '<=', $endDatum->format('Y-m-d' . ' 23:59:59'))
            ->orderBy('datum', 'desc')
            ->get();


        //deutsches datum-format
        foreach ($data as $eintrag) {
            $temp = new \DateTime($eintrag->datum);
            $eintrag->datum = $temp->format('d-m-Y H:i:s');
        }


        $liste = DB::table('klienten_view')
            ->where('active', 'Y')
            ->orderBy('vorname', 'asc')
            ->get();

        //return view('doku/dokuIndex', compact('data','liste','klienten_id'));
        return view('doku/dokuIndex')
            ->with('data', $data)
            ->with('liste', $liste)
            ->with('klienten_id', $klienten_id)
            ->with('startDatum', $startDatum->format('d-m-Y'))
            ->with('endDatum', $endDatum->format('d-m-Y'));
    }

    public function alle()
    {
        //prüfen, ob ein datum mitgegeben wurde ansonsten heutiges Datum -3 Monate
        if (isset($_POST['startDatum'])) {
            if ($_POST['startDatum'] != "") {
                $startDatum = \DateTime::createFromFormat('d-m-Y', $_POST['startDatum']);
            } else {
                $startDatum = new \DateTime();
                $startDatum->modify('-3 month');
            }
        } else {
            $startDatum = new \DateTime();
            $startDatum->modify('-3 month');
        }

        //nochmal für das enddatum
        if (isset($_POST['endDatum'])) {
            if ($_POST['endDatum'] != "") {
                $endDatum = \DateTime::createFromFormat('d-m-Y', $_POST['endDatum']);
            } else {
                $endDatum = new \DateTime();
            }
        } else {
            $endDatum = new \DateTime();
        }

        //klienten_id ist dann "alle"
        $klienten_id = "alle";

        //daten für die inhalte
        $data = DB::table('dokumentation_view')
            ->whereDate('datum', '>=', $startDatum->format('Y-m-d' . ' 00:00:00'))
            ->whereDate('datum', '<=', $endDatum->format('Y-m-d' . ' 23:59:59'))
            ->orderBy('datum', 'desc')
            ->get();

        //liste für das menü
        $liste = DB::table('klienten_view')
            ->where('active', 'Y')
            ->orderBy('vorname', 'asc')
            ->get();

        return view('doku/dokuIndex')
            ->with('data', $data)
            ->with('liste', $liste)
            ->with('klienten_id', $klienten_id)
            ->with('startDatum', $startDatum->format('d-m-Y'))
            ->with('endDatum', $endDatum->format('d-m-Y'));
    }

    public function toDo()
    {
        //prüfen, ob ein datum mitgegeben wurde ansonsten heutiges Datum -3 Monate
        if (isset($_POST['startDatum'])) {
            if ($_POST['startDatum'] != "") {
                $startDatum = \DateTime::createFromFormat('d-m-Y', $_POST['startDatum']);
            } else {
                $startDatum = new \DateTime();
                $startDatum->modify('-3 month');
            }
        } else {
            $startDatum = new \DateTime();
            $startDatum->modify('-3 month');
        }

        //nochmal für das enddatum
        if (isset($_POST['endDatum'])) {
            if ($_POST['endDatum'] != "") {
                $endDatum = \DateTime::createFromFormat('d-m-Y', $_POST['endDatum']);
            } else {
                $endDatum = new \DateTime();
            }
        } else {
            $endDatum = new \DateTime();
        }

        //klienten_id ist dann null
        $klienten_id = "todo";

        //daten für die inhalte
        $data = DB::table('dokumentation_view')
            ->where('todo', '1')
            ->orderBy('datum', 'desc')
            ->get();

        //deutsches datum-format
        foreach ($data as $eintrag) {
            $temp = new \DateTime($eintrag->datum);
            $eintrag->datum = $temp->format('d-m-Y H:i:s');
        }

        //liste für das menü
        $liste = DB::table('klienten_view')
            ->where('active', 'Y')
            ->orderBy('vorname', 'asc')
            ->get();

        return view('doku/dokuIndex')
            ->with('data', $data)
            ->with('liste', $liste)
            ->with('klienten_id', $klienten_id)
            ->with('startDatum', $startDatum->format('d-m-Y'))
            ->with('endDatum', $endDatum->format('d-m-Y'));
    }

    /**
     * Das ist die Methode, die einen neuen Eintrag in die Dokumentation einfügt.
     *
     * @return mixed
     */
    public function neuerEintrag()
    {
        // zuerst prüfen, ob die daten so passen. wir brauchen:
        // id vom klient, wenn vorhanden, sonst allgemeiner bereich
        if (!isset($_POST['klient_id']) || !ctype_digit($_POST['klient_id'])) {
            $_POST['klient_id'] = 0;
        }
        // text
        if (!isset($_POST['text']) || $_POST['text'] == "") {
            return "Es muss ein Text eingegeben werden"; // ToDo: hier noch ne view bauen.
        }
        // wichtig-flag?
        if (!isset($_POST['wichtig'])) {
            $_POST['wichtig'] = 0;
        } else $_POST['wichtig'] = 1;

        // to-do-flag?
        if (!isset($_POST['todo'])) {
            $_POST['todo'] = 0;
        } else $_POST['todo'] = 1;

        //insert befehl:
        DB::table('dokumentation')->insert(
            [
                'klient_id' => $_POST['klient_id'],
                'text' => $_POST['text'],
                'wichtig' => $_POST['wichtig'],
                'todo' => $_POST['todo']
            ]
        );

        return back()->withInput();
    }

    public function erledigt($doku_id)
    {
        DB::table('dokumentation')
            ->where('id', $doku_id)
            ->update(['todo' => 0]);

        return back()->withInput();
    }

    public function suche()
    {
        if (isset($_POST['suchen'])) {
            $suchstring = '%' . $_POST['suchen'] . '%';
        }
        else $suchstring = 'es wurde nichts übergeben';


        $klienten_id = 'suche';
        $startDatum = new \DateTime();
        $endDatum = new \DateTime();
        $startDatum->modify('-3 year');

        $data = DB::table('dokumentation_view')
            ->where('text', 'like', $suchstring)
            ->orderBy('datum', 'desc')
            ->get();

        //deutsches datum-format
        foreach ($data as $eintrag) {
            $temp = new \DateTime($eintrag->datum);
            $eintrag->datum = $temp->format('d-m-Y H:i:s');
        }

        //liste für das menü
        $liste = DB::table('klienten_view')
            ->where('active', 'Y')
            ->orderBy('vorname', 'asc')
            ->get();

        return view('doku/dokuIndex')
            ->with('data', $data)
            ->with('liste', $liste)
            ->with('klienten_id', $klienten_id)
            ->with('startDatum', $startDatum->format('d-m-Y'))
            ->with('endDatum', $endDatum->format('d-m-Y'));
    }
}
