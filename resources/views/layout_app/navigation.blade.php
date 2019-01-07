<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">
                                    {{isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email}}
                                </strong>
                            </span> <span class="text-muted text-xs block">Favoriten<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="{{ isActiveRoute('dashboard') }}">
                <a href="{{ url('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ isActiveRoute('doku') }}">
                <a href="{{ url('/doku') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dokumentation</span></a>
            </li>

            <li>
                <a class="{{ isActiveRoute('klienten') }}"><i class="fa fa-th-large"></i>
                    <span class="nav-label">Klientenbezogen</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('/klienten') }}">Übersicht</a></li>
                    <li><a href="{{ url ('klient/create') }}">Anlegen</a></li>
                    <li><a href="/ueberweisung">TG Überweisungen</a></li>

                </ul>
            </li>



        </ul>

    </div>
</nav>
