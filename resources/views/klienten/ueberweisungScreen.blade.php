@extends('layout_app.app')

@section('title', 'Main page')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">

                <table id="klienten" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Erstellen?</th>
                        <th>Name</th>
                        <th>Vorname</th>
                        <th>Außenwohnung</th>
                        <th>Taschengeld</th>
                        <th>Eigener Betrag (€)</th>
                        <th>Betreff</th>
                    </tr>
                    </thead>

                    <tbody>
                    <form method="post" action="/doUeberweisung">
                        {{ csrf_field() }}
                        @foreach($data as $klient)
                            {{--hidden zeug für die form--}}
                            <input type="hidden" name="{{$klient->name}}[name]" value="{{$klient->name}}">
                            <input type="hidden" name="{{$klient->name}}[vorname]" value="{{$klient->vorname}}">
                            <input type="hidden" name="{{$klient->name}}[iban]" value="{{$klient->iban}}">
                            <input type="hidden" name="{{$klient->name}}[taschengeld]" value="{{$klient->taschengeld}}">


                            <tr>
                                <td><input type="checkbox" name="{{$klient->name}}[erstellen]" checked></td>
                                <td>{{$klient->name}}</td>
                                <td>{{$klient->vorname}}</td>
                                <td><input type="checkbox" name="{{$klient->name}}[aussenwohnung]"
                                           @if ($klient->aussenwohnung == 'Y') checked @endif></td>
                                <td>{{$klient->taschengeld}}</td>
                                <td><input name="{{$klient->name}}[eigenerBetrag]" type="number" step="0.01"></td>
                                <td><input name="{{$klient->name}}[betreff]" type="text"
                                           value="TG/WiG {{date('y/m')}} {{$klient->name}}"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">
                                <button type="submit">OK</button>
                            </td>

                        </tr>
                    </form>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
