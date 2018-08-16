@extends('layouts.base')

@section('breadcrumb')
     <li class="breadcrumb-item"><a href="{{ route('cash.registers.index') }}">ventas</a></li>
@stop

@section('content')
    <div class="col-xs-12">
        <div class="row" >
                <div class="invoice">
                        <div class="row header visible-print-block">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        @if ($commerce->logo_path)
                                            <img src="{{  route('commerces.logo', $commerce) }} " alt="" class="img-rounded pull-right" width="75">
                                        @endif
                                        <p><strong>{{$commerce->name}}</strong></p>
                                        <p>{{$commerce->patent_name}}</p>
                                        <p>{{$commerce->address}}</p>
                                        <p>{{$commerce->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row header">
                            <div class="col-xs-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Cierres
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>{{$registers->count()}}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Fecha desde
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>{{$registers->first()->created_at}}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Fecha hasta
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>{{$registers->last()->closing_date}}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Movimiento</th>
                                            <th class="center">Ventas</th>
                                            <th class="right">Productos</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td class="center">1</td>
                                                <td class="left">Pagos en Efectivo</td>
                                                <td class="center">{{ $sales->where('payment_method_id', 1)->count() }}</td>
                                                <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 1), '*.details.*.lot'))  }}</td>
                                                <td class="right">{{ number_format($sales->where('payment_method_id', 1)->sum('total'),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">2</td>
                                                <td class="left">Pagos con tarjeta</td>
                                                <td class="center">{{ $sales->where('payment_method_id', 2)->count() }}</td>
                                                <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 2), '*.details.*.lot'))  }}</td>
                                                <td class="right">{{ number_format($sales->where('payment_method_id', 2)->sum('total'),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">3</td>
                                                <td class="left">Pagos con cheques</td>
                                                <td class="center">{{ $sales->where('payment_method_id', 3)->count() }}</td>
                                                <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 3), '*.details.*.lot'))  }}</td>
                                                <td class="right">{{ number_format($sales->where('payment_method_id', 3)->sum('total'),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">4</td>
                                                <td class="left">Creditos</td>
                                                <td class="center">{{  $sales->where('payment_method_id', 4)->count() }}</td>
                                                <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 4), '*.details.*.lot'))  }}</td>
                                                <td class="right">{{ number_format($sales->where('payment_method_id', 4)->sum('total'),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="center">5</td>
                                                <td class="left">Abonos a creditos</td>
                                                <td class="center">N/A</td>
                                                <td class="right">N/A</td>
                                                <td class="right">{{ number_format($registers->sum('orders.payments.amount'),2) }}</td>
                                            </tr>
                                        </tbody>
                                </table>

                                <div class="row">

                                    <div class="col-lg-4 col-sm-5 notice">

                                    </div>

                                    <div class="col-lg-4 col-lg-offset-4 col-sm-5 col-sm-offset-2 recap">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right">Q. {{ number_format($sales->sum('total'),2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Creditos <i class="text-danger">(-)</i></strong></td>
                                                    <td class="right text-danger">Q. {{ number_format($sales->where('payment_method_id', 4)->sum('total'),2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>Q. {{ number_format($sales->whereNotIn('payment_method_id', [4])->sum('total'),2) }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="hidden-print btn btn-info" onclick="javascript:window.print();"><i class="  fa fa-print"></i> Imprimir</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
        </div>

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" class="hidden">
  <thead>
    <tr>
      <th></th>
      <th>Ventas</th>
      <th>Productos</th>
      <th>Total</th>
    </tr>
  </thead>
        <tbody>
        <tr>
        <th>Efectivo</th>
        <td class="center">{{ $sales->where('payment_method_id', 1)->count() }}</td>
        <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 1), '*.details.*.lot'))  }}</td>
        <td class="right">{{ number_format($sales->where('payment_method_id', 1)->sum('total'),2) }}</td>
        </tr>
        <tr>
        <th>Tarjeta</th>
        <td class="center">{{ $sales->where('payment_method_id', 2)->count() }}</td>
        <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 2), '*.details.*.lot'))  }}</td>
        <td class="right">{{ number_format($sales->where('payment_method_id', 2)->sum('total'),2) }}</td>
        </tr>
        <tr>
        <th>Cheque</th>
        <td class="center">{{ $sales->where('payment_method_id', 3)->count() }}</td>
        <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 3), '*.details.*.lot'))  }}</td>
        <td class="right">{{ number_format($sales->where('payment_method_id', 3)->sum('total'),2) }}</td>
        </tr>
        <tr>
        <th>Credito</th>
        <td class="center">{{ $sales->where('payment_method_id', 4)->count() }}</td>
        <td class="right">{{ array_sum(data_get($sales->where('payment_method_id', 4), '*.details.*.lot'))  }}</td>
        <td class="right">{{ number_format($sales->where('payment_method_id', 4)->sum('total'),2) }}</td>
        </tr>
        </tbody>
</table>

    </div>
@stop

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>

    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        yAxis: {
            allowDecimals: false,
            title: {
            text: 'Quetzales'
            }
        },
        tooltip: {
            formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
</script>

@endsection