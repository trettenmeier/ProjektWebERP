@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <!--  das ist für suchfunktion und zeitraum -->
            <div class="col-lg-3">
                <form method="post" action="/doku/suche">
                    {{csrf_field()}}
                    <div class="input-group">
                        <input name="suchen" type="text" class="form-control" placeholder="Suche">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">OK</button>
                        </span>
                    </div>
                </form>
            </div>

            <form method="post" action="/doku/{{$klienten_id}}">
                {{ csrf_field() }}
                <div class="col-lg-8 col-lg-offset-1">
                    <div class="row">
                        <div class="col-lg-2">
                            <p>Zeige Einträge ab:
                                <input name="startDatum" type="text" id="date_1" placeholder="{{$startDatum}}">
                            </p>
                        </div>
                        <div class="col-lg-2">
                            <p>Zeige Einträge bis:
                                <input name="endDatum" type="text" id="date_2" placeholder="{{$endDatum}}">
                            </p>
                        </div>
                        <div class="col-lg-2">
                            <p>
                                Senden:
                                <button class="btn btn-block btn-w-m btn-primary" type="submit">OK</button>

                            </p>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="row">
            <!--------- das ist für das linke menü ------------->
            <div class="col-lg-3">
                <!-- obere button-reihe -->
                <div class="row">
                    <div class="col-lg-12" style="padding-bottom: 20px">
                        <form method="post" action="/doku">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-block btn-w-m
                        @if ($klienten_id === 0) btn-primary
                                @else btn-default
                                @endif">Allgemeine Dokumentation
                            </button>
                        </form>
                    </div>

                    @foreach($liste as $klient)
                        <div class="col-lg-12">
                            <form method="post" action="/doku/{{$klient->klienten_id}}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-block btn-w-m
                                @if ($klienten_id == $klient->klienten_id) btn-primary
                                @else btn-default
                                @endif">
                                    {{$klient->vorname . " " . $klient->name}}</button>
                            </form>
                        </div>
                    @endforeach

                </div>

                <!-- unterer button-block -->
                <div class="row">
                    <div class="col-lg-12" style="padding-top: 20px">
                        <form method="post" action="/doku/todo">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-block btn-w-m
                            @if ($klienten_id === "todo") btn-primary
                            @else btn-default
                            @endif">
                                <i class="fa fa-check-square-o"></i>
                                Zeige alle To-Do
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <form method="post" action="/doku/alle">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-block btn-w-m
                        @if ($klienten_id === "alle") btn-primary
                        @else btn-default
                        @endif">
                                <i class="fa fa-book"></i>
                                Alle Einträge
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-12" style="padding-top: 20px">
                        <button type="button" class="btn btn-block btn-w-m btn-default">
                            <i class="fa fa-archive"></i>
                            Ehemalige Klienten
                        </button>
                    </div>

                </div>
            </div>

            <!----------- das ist der main content ----------->
            <div class="col-lg-9" style="min-height: 75vh; height: 75vh;">

                <div class="col-lg-12" style="position: relative; height: 85%; overflow-y: scroll;">

                    <!-- die anzeige des inhaltes -->
                    @foreach($data as $eintrag)
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            {{$eintrag->datum}}
                                        </div>

                                        <div class="col-lg-4 text-center">
                                            @if($eintrag->todo == 1)
                                                <b>Noch unerledigt!</b>

                                        </div>

                                        <div class="col-lg-4 text-right">

                                            <a href="/doku/erledigt/{{$eintrag->doku_id}}"> <i class="fa fa-check"></i>
                                                Als erledigt kennzeichnen</a>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="panel-body"
                                     @if ($eintrag->wichtig == "1") style="background-color: lightcoral " @endif>

                                    {{$eintrag->text}}
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- editor -->
                <div class="col-lg-12" style="height: 20%; min-height: 20%;padding-top: 20px">
                    <form method="post" action="/doku/neuerEintrag">
                        {{ csrf_field() }}
                        <input type="hidden" name="klient_id" value="{{$klienten_id}}">

                        <textarea name="text" placeholder="Neuer Eintrag"
                                  style="width:100%;height:100px;resize: none"></textarea>

                        <label class="checkbox-inline"> <input name="todo" type="checkbox" value="yes"
                                                               id="inlineCheckbox1">
                            Als "Unerledigt" markieren </label>
                        <label class="checkbox-inline"><input name="wichtig" type="checkbox" value="yes"
                                                              id="inlineCheckbox2">
                            Als "Wichtig" markieren </label>

                        <button class="btn btn-white" type="reset">Zurücksetzen</button>
                        <button class="btn btn-primary" type="submit">Speichern</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function () {
            $("#date_1").datepicker({
                format: "dd-mm-yyyy",
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });

        $(function () {
            $("#date_2").datepicker({
                format: "dd-mm-yyyy",
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>

@endsection
  