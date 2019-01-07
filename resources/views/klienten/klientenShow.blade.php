@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">

        <div class="col-lg-8">
            <form role="form" method="post" action="/klient/edit/{{$data->id}}">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Klient anzeigen: {{$data->vorname." ".$data->name}}</h5>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit"><strong>Klient bearbeiten</strong></button>
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
                                                    <label>Vorname</label>
                                                    <input name="vorname" type="text" value="{{$data->vorname}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input name="name" type="text" value="{{$data->name}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geburtsdatum</label>
                                                    <input name="name" type="text" value="{{$data->geburtsdatum}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Geschlecht</label>
                                                    <input name="name" type="text"
                                                           @if ($data->geschlecht == 'm' || $data->geschlecht == 'M') value="Männlich"
                                                           @else value="Weiblich"
                                                           @endif
                                                           class="form-control" disabled
                                                           style="background-color: white">
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
                                                    <input name="name" type="text"
                                                           @if ($data->aussenwohnung == 'y' || $data->aussenwohnung == 'Y' ) value="Außenwohnung"
                                                           @else value="In der WG"
                                                           @endif
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufnahmedatum</label>
                                                    <input name="name" type="text" value="{{$data->aufgenommen_am}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Entlassdatum</label>
                                                    <input name="name" type="text" value="{{$data->entlassen_am}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Aufgenommmen?</label>
                                                    <input name="name" type="text"
                                                           @if ($data->active == 'y' || $data->active == 'Y' ) value="Aufgenommen"
                                                           @else value="Hilfe beendet / Noch nicht aufgenommen"
                                                           @endif
                                                           class="form-control" disabled
                                                           style="background-color: white">
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
                                                    <input name="name" type="text" value="{{$data->fallverantwortlich}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Zuständiges Beratungszentrum</label>
                                                    <input name="name" type="text" value="{{$data->beratungszentrum}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Wirtschaftliche Jugendhilfe</label>
                                                    <input name="name" type="text" value="{{$data->wirtsch_juhi}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Buchungszeichen für Kostenbeitrag</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->buchungszeichen_kostenbeitrag}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
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
                                                    <input name="name" type="text" value="{{$data->schule_ag}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Angestrebter Abschluss</label>
                                                    <input name="name" type="text" value="{{$data->angestr_abschluss}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 1</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner1_name}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 1</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner1_tel}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 1</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner1_email}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ansprechpartner 2</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner2_name}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefon Ansprechpartner 2</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner2_tel}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                                <div class="form-group">
                                                    <label>E-Mail Ansprechpartner 2</label>
                                                    <input name="name" type="text"
                                                           value="{{$data->ansprechpartner2_email}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
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
                                                    <input name="name" type="text" value="{{$data->konto_iban}}"
                                                           class="form-control" disabled
                                                           style="background-color: white">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


@endsection