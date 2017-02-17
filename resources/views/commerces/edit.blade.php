<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
{!! Alert::render() !!}
<h3>{{ $commerce->name }}</h3>
{!! Form::model($commerce, ['route' => ['commerces.update', $commerce], 'method' => 'PUT']) !!}
	@include('commerces.partials.fields')
	<button type="submit">Guardar</button>
{!! Form::close() !!}

</body>
</html>
