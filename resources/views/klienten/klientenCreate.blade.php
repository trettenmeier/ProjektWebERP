@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">

        <div class="col-lg-8">
            <form role="form" method="post" action="/klient/create">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Klient anlegen</h5>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit"><strong>Klient anlegen</strong></button>
                    </div>

                    <div class="ibox-content" style="">
                        <div class="row">

                            {{csrf_field()}}
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">
                                            Stammdaten</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Organisatorisch</a>
                                    </li>
                                    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Beratungszentrum</a>
                                    </li>
                                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">Schule /
                                            Beruf</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">Konto</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <!-- karte stammdaten -->
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Stammdaten</h3>

                                                <div class="form-group">
                                                    <label>Vorname *</label>
                                                    <input name="vorname" type="text" placeholder="Vorname" required
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Name *</label>
                                                    <input name="name" type="text" placeholder="Name" required
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geburtsdatum *</label>
                                                    <input id="datepicker" onkeydown="return false" name="geburtsdatum"
                                                           type="text" required
                                                           placeholder="Geburtsdatum"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geschlecht</label>
                                                    <select class="form-control m-b" name="geschlecht">
                                                        <option value="w">Weiblich</option>
                                                        <option value="m">Männlich</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <!-- karte organisatorisch -->
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Organisatorisch</h3>

                                                <div class="form-group">
                                                    <label>Wohnort</label>
                                                    <select class="form-control m-b" name="aussenwohnung">
                                                        <option value="n">In der WG</option>
                                                        <option value="y">Außenwohnung</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufnahmedatum</label>
                                                    <input id="datepicker_2" onkeydown="return false" name="aufnahme"
                                                           type="text"
                                                           placeholder="Aufnahmedatum"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Entlassdatum</label>
                                                    <input id="datepicker_3" onkeydown="return false" name="entlassen"
                                                           type="text"
                                                           placeholder="Entlassdatum"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufgenommmen?</label>
                                                    <select class="form-control m-b" name="active">
                                                        <option value="y">Aufgenommen</option>
                                                        <option value="n">Hilfe beendet / Noch nicht aufgenommen
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <!-- karte Beratungszentrum -->
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Beratungszentrum</h3>

                                                <div class="form-group">
                                                    <label>Fallverantwortlicher Mitarbeiter im Beratungszentrum</label>
                                                    <input name="fallverantwortlich" type="text"
                                                           placeholder="Fallverantwortlich" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Zuständiges Beratungszentrum</label>
                                                    <input name="bz" type="text"
                                                           placeholder="Zuständiges Beratungszentrum"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Wirtschaftliche Jugendhilfe</label>
                                                    <input name="wjh" type="text"
                                                           placeholder="Zuständiger Mitarbeiter WJH"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Buchungszeichen für Kostenbeitrag</label>
                                                    <input name="buchungszeichen_kb" type="text"
                                                           placeholder="Buchungszeichen Kostenbeitrag"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-4" class="tab-pane">
                                        <div class="panel-body">
                                            <!-- karte schule/beruf -->
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Schule / Beruf</h3>

                                                <div class="form-group">
                                                    <label>Schule / Arbeitgeber </label>
                                                    <input name="schule-ag" type="text"
                                                           placeholder="Schule / Arbeitgeber" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Angestrebter Abschluss</label>
                                                    <input name="angestr_abschluss" type="text"
                                                           placeholder="Angestrebter Abschluss" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_name" type="text"
                                                           placeholder="Ansprechpartner" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_tel" type="text"
                                                           placeholder="Telefon Ansprechpartner" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_email" type="email"
                                                           placeholder="E-Mail Ansprechpartner" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_name" type="text"
                                                           placeholder="Ansprechpartner" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_tel" type="text"
                                                           placeholder="Telefon Ansprechpartner" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_email" type="email"
                                                           placeholder="E-Mail Ansprechpartner" class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-5" class="tab-pane">
                                        <div class="panel-body">
                                            <!-- karte konto -->
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Konto</h3>
                                                <div class="form-group">
                                                    <label>Kontonummer (IBAN)</label>
                                                    <input name="iban" type="text" placeholder="IBAN"
                                                           class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

            </form>

        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        $(function () {
            $("#datepicker").datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: false,
                autoclose: true
            });
            $("#datepicker_2").datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: false,
                autoclose: true
            });
            $("#datepicker_3").datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: false,
                autoclose: true
            });
        });
    </script>

@endsection