@extends('layouts.base')
@section('styles')
    {!! Html::style('css/easy-autocomplete.css') !!}
@stop
@section('breadcrumb')
     <li class="breadcrumb-item"><a href="">Facturas</a></li>
     <li class="breadcrumb-item active">Nueva</li>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default " style="border-top: 2px solid #20a8d8">
                <div class="panel-heading">
                    <i class="fa fa-shopping-cart"></i>
                    <strong>Factura</strong>
                    <small>Nuevo</small>
                </div>
                {!! Form::open(['route' => ['bills.store'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' =>'CreateOrderForm']) !!}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('bills.partials.fields')
                            <div class="col-xs-12">
                                <p id="error" class="text-danger hidden ">NIT/DPI no encontrado, Agrega Nombre y Dirección</p>
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <div class="panel-footer">
                    <button type="submit" id="Submit" class="btn btn-primary">
                        Siguiente
                        <i class="fa fa-angle-double-right "></i>
                    </button>

                    <a id="btn-cancel" href="{{ URL::previous() }}" class="btn btn-link text-danger">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>
                    <a href="#" id="EditPeople" class="btn btn-default pull-right hidden"><i class="fa fa-pencil"></i> Editar</a>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@stop

@section('scripts')
    {!! Html::script('js/easy-autocomplete.js') !!}
    <script>
      $('#Submit').on('click', function (e) {
            e.preventDefault();
            $('#btn-cancel').fadeOut(1);
            $(this).attr('disabled', 'disabled');
            $(this).text('Espere...')
            $('#CreateOrderForm').submit();
      })
    </script>

    <script>
        $(document).ready(function () {
            $("#nit").val('');        
            $("#field_address").val('');
            $("#field_address").val('');
            $("#nit").change(function(event){
                var nit = $(this).val();
                var url =  '/auto-complete/people/'+nit;
                $.getJSON(url, null, function (result) {
                    if(result.success){
                        $("#EditPeople").removeClass('hidden');
                        $("#field_name").attr('disabled', 'disabled')
                        $("#field_address").attr('disabled', 'disabled')
                        $("#error").addClass('hidden');
                        $("#field_name").val(result.people.name);
                        $("#field_address").val(result.people.address);
                    }
                    else{
                        $("#error").removeClass('hidden');
                        $("#field_name").removeAttr('disabled');        
                        $("#field_address").removeAttr('disabled');
                        $("#field_name").val('');        
                        $("#field_address").val('');
                        
                    }
                });
            });

            $("#EditPeople").click(function(event){
                event.preventDefault();
                $("#field_name").removeAttr('disabled');        
                $("#field_address").removeAttr('disabled');
                $(this).addClass('hidden');
            });
            /*
            
            $("#nit").easyAutocomplete({
              getValue: "nit",
              template :{
                type:"description",
                fields:{
                    description:"name"
                }
              },
              list: {
                match: {
                  enabled: true
                },
                onSelectItemEvent: function() {
                    var selectedItemValue = $("#nit").getSelectedItemData();
                    $("#name").val(selectedItemValue.name).trigger("change");
                    $("#address").val(selectedItemValue.address).trigger("change");
                }
              },
              theme: "bootstrap",
              ajaxSettings: {
                dataType: "json",
                method: "GET",
                data: {
                  //dataType: "json"
                }
              },
              preparePostData: function(data) {
                data.term = $("#nit").val();
                return data;
              },
              requestDelay: 300}).change(function () {
                $('#name').val('');
                $('#address').val('');
            });
            */
        });
    </script>
@stop


