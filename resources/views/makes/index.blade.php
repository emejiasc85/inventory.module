@extends('layouts.base')

@section('breadcrumb')
	 <li class="breadcrumb-item">Marcas</li>
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Marcas</strong>
                    <small>Listado</small>
                </div>

                <div class="card-block">
                    <div class="row">
                       <table class="table">
                           <tr>
                               <th></th>
                               <th>Marca</th>
                               <th>Acciones</th>
                           </tr>
                           @foreach ($makes as $make)
                               <tr>
                                   <td></td>
                                   <td>{{ $make->name }}</td>
                                   <td><a href="{{ $make->editUrl }}" class="btn btn-success "> <i class="fa fa-pencil"></i>Editar</a></td>
                               </tr>
                           @endforeach
                       </table>
                    </div>
                    <!--/.row-->
                </div>
                <div class="card-footer">

                </div>

            </div>

        </div>
	</div>
@stop


