@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">

        <div class="col-lg-8">
            <form role="form" method="post" action="/klient/edit">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Klient bearbeiten: {{$data->vorname." ".$data->name}}</h5>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit"><strong>Speichern</strong></button>
                    </div>

                    <div class="ibox-content" style="">
                        <div class="row">

                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$data->id}}">
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
                                                    <input name="vorname" type="text" value="{{$data->vorname}}" required
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Name *</label>
                                                    <input name="name" type="text" value="{{$data->name}}" required
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geburtsdatum *</label>
                                                    <input id="datepicker" onkeydown="return false" name="geburtsdatum"
                                                           type="text" required value="{{$data->geburtsdatum}}"
                                                           placeholder="Geburtsdatum"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geschlecht</label>
                                                    <select class="form-control m-b" name="geschlecht">
                                                        <option value="w" @if($data->geschlecht == "w" || $data->geschlecht == "W") selected @endif>Weiblich</option>
                                                        <option value="m" @if($data->geschlecht == "m" || $data->geschlecht == "M") selected @endif>Männlich</option>
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
                                                        <option value="n" @if($data->aussenwohnung == "n" || $data->aussenwohnung == "N") selected @endif>In der WG</option>
                                                        <option value="y" @if($data->aussenwohnung == "y" || $data->aussenwohnung == "Y") selected @endif>Außenwohnung</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufnahmedatum</label>
                                                    <input id="datepicker_2" onkeydown="return false" name="aufnahme"
                                                           type="text"
                                                           value="{{$data->aufgenommen_am}}"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Entlassdatum</label>
                                                    <input id="datepicker_3" onkeydown="return false" name="entlassen"
                                                           type="text"
                                                           value="{{$data->entlassen_am}}"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufgenommmen?</label>
                                                    <select class="form-control m-b" name="active">
                                                        <option value="y" @if($data->active == "y" || $data->active == "Y") selected @endif>Aufgenommen</option>
                                                        <option value="n" @if($data->active == "n" || $data->active == "N") selected @endif>Hilfe beendet / Noch nicht aufgenommen
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
                                                           value="{{$data->fallverantwortlich}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Zuständiges Beratungszentrum</label>
                                                    <input name="bz" type="text"
                                                           value="{{$data->beratungszentrum}}"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Wirtschaftliche Jugendhilfe</label>
                                                    <input name="wjh" type="text"
                                                           value="{{$data->wirtsch_juhi}}"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Buchungszeichen für Kostenbeitrag</label>
                                                    <input name="buchungszeichen_kb" type="text"
                                                           value="{{$data->buchungszeichen_kostenbeitrag}}"
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
                                                          value="{{$data->schule_ag}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Angestrebter Abschluss</label>
                                                    <input name="angestr_abschluss" type="text"
                                                           value="{{$data->angestr_abschluss}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_name" type="text"
                                                    value="{{$data->ansprechpartner1_name}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_tel" type="text"
                                                           value="{{$data->ansprechpartner1_tel}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 1</label>
                                                    <input name="ansprechpartner1_email" type="email"
                                                           value="{{$data->ansprechpartner1_email}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_name" type="text"
                                                           value="{{$data->ansprechpartner2_name}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_tel" type="text"
                                                           value="{{$data->ansprechpartner2_tel}}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 2</label>
                                                    <input name="ansprechpartner2_email" type="email"
                                                           value="{{$data->ansprechpartner2_email}}" class="form-control">
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
                                                    <input name="iban" type="text" value="{{$data->konto_iban}}"
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