<ul class="nav navbar-nav navbar-right visible-md visible-lg">

    <li><span class="timer"><i class="icon-clock"></i> <span id="clock"><!-- JavaScript clock will be displayed here, if you want to remove clock delete parent <li> --></span></span></li>
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Ingresar</a></li>
    @else
    <li class="dropdown visible-md visible-lg">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i></a>
        <ul class="dropdown-menu">
            <li class="dropdown-menu-header text-center">
                <strong>{{auth()->user()->name}}</strong>
            </li>
            <li>
                <a href="{{ Auth::user()->editAuthPassword }}"><i class="fa fa-key"></i>Cambiar Contraseña</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>
    </li>
    @endif
</ul>
