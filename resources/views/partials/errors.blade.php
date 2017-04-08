@if (count($errors) > 0)
    <div class="alert alert-danger" data-dismiss="alert" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> <strong>¡Alerta!</strong> Por favor corrige los siguientes errores.</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            @if(Session::has('error-message'))
                <li>{{ Session::get('error-message') }}</li>
            @endif
        </ul>
    </div>
@endif