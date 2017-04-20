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
            $("#nit").easyAutocomplete({
              url: "/auto-complete/people",
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
        });
    </script>
@stop


