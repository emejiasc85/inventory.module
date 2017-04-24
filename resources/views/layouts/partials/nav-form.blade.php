{{ Form::open(['route' => ['stocks.index'], 'method' => 'get', 'class' => 'navbar-form navbar-left']) }}
    <i class="fa fa-search"></i>
    <input type="text" name="name" class="form-control" placeholder="Buscar">
{{ Form::close() }}
