@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">

        <div class="row">
            @foreach ($data as $eintrag)
                <div class="col-lg-4">
                    <div class="contact-box">
                        <h2><strong>{{$eintrag->vorname." ".$eintrag->name}}</strong></h2>
                        <div class="col-lg-6">
                            <p>Geburtsdatum</p>
                            <p>Wohnt in</p>
                            <p>Aufnahmedatum</p>
                            <p>Fallverantwortlich (BZ)</p>
                            <p>Aktionen:</p>
                        </div>
                        <div class="col-lg-6">
                            <p>{{$eintrag->geburtsdatum}}</p>
                            <p>{{$eintrag->aussenwohnung}}</p>
                            <p>{{$eintrag->aufgenommen_am}}</p>
                            <p>{{$eintrag->fallverantwortlich}}</p>
                            <p>
                                <a href="/klient/show/{{$eintrag->id}}">Alle Daten anzeigen</a><br>
                                <a href="/doku/{{$eintrag->id}}">Zur Dokumentation</a><br>
                                <a href="/klient/edit/{{$eintrag->id}}">Daten bearbeiten</a><br>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach

        </div>


    <!-- tabellen-übersicht
        <div class="row">
            <div class="col-lg-12">

                <table id="klienten" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Vorname</th>
                        <th>Geburtsdatum</th>
                        <th>Geschlecht</th>
                        <th>Außenwohnung</th>
                        <th>Aufnahme</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Vorname</th>
                        <th>Geburtsdatum</th>
                        <th>Geschlecht</th>
                        <th>Außenwohnung</th>
                        <th>Aufnahme</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($data as $klient)
        <tr>
            <td>{{$klient->name}}</td>
                            <td>{{$klient->vorname}}</td>
                            <td>{{$klient->geburtsdatum}}</td>
                            <td>{{$klient->geschlecht}}</td>
                            <td>{{$klient->aussenwohnung}}</td>
                            <td>{{$klient->aufgenommen_am}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
-->


    </div>



    <script>
        //Data Table initialisieren
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#klienten tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Suchen in ' + title + '" />');
            });

            // DataTable
            var table = $('#klienten').DataTable({
                "paging": false,
                "order": [[0, "asc"]]
            });

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });

            $('#klienten tfoot tr').appendTo('#klienten thead'); //suchboxen nach oben
        });

    </script>
@endsection
