<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="{{ url('/') }}">
    </a>
    <ul class="nav navbar-nav hidden-md-down b-r-1">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>
    </ul>
    @include('layouts.partials.nav-form')
    @include('layouts.partials.nav-right')
</header>