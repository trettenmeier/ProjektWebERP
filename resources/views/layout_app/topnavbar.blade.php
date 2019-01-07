
<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom">
                <div class="form-group">
                    <input type="text" placeholder="" class="form-control" name="top-search"
                           id="top-search"/>
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"> </i>Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">{{ csrf_field() }}</form>
            </li>
        </ul>
    </nav>
</div>
