@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('people.index') }}">Personas</a></li>
<li class="breadcrumb-item">{{ $people->name }}</li>
@stop

@section('content')
<div class="row profile">

    <div class="col-md-4">

        <div class="panel panel-default">
            <div class="panel-body">
                @if ($people->avatar == null)
                    <img class="img-responsive" src="{{ asset('img/picture.svg') }}">
                @else
                    <img class="img-responsive" src="{{ route('people.avatar', $people) }}" >
                @endif
                <a href="{{ $people->editUrl }}" class="btn btn-link pull-right"><span class="fa fa-pencil text-success"></span></a>
                <h2 class="text-center"><strong>
                    {{ $people->name }}</strong>
                </h2>
                <h4 class="text-center"><small><i class="fa fa-map-marker"></i> {{ $people->address }}</small></h4>
                <h4 class="text-center"><small><i class="fa fa-phone"></i> {{ $people->phone }}</small></h4>

                <hr>
                <div class="row">
                    @if ($people->facebook != null)
                        <div class="col-xs-6">
                            <a href="https://web.facebook.com/{{ $people->facebook }}" target="_black" style="margin-bottom: 4px" class="btn btn-sm btn-facebook btn-block" ><span>Facebook</span></a>
                        </div>
                    @endif
                    @if ($people->instagram)
                        <div class="col-xs-6">
                            <a href="https://www.instagram.com/{{ $people->instagram }}" target="_black" style="margin-bottom: 4px" class="btn btn-sm btn-instagram btn-block"><span>Instagram</span></a>
                        </div>
                    @endif
                </div>
                <hr>


                <div class="row text-center">
                    <div class="col-xs-4">
                        <div><strong>{{ $bills->count() }}</strong></div>
                        <div><small>Compras</small></div>
                    </div><!--/.col-->
                    <div class="col-xs-4">
                        @php
                            $lot = 0;
                            foreach ($bills as $bill) {
                                $lot = $lot + $bill->details->sum('lot');
                            }
                        @endphp
                        <div><strong>{{ $lot }}</strong></div>
                        <div><small>Productos</small></div>
                    </div><!--/.col-->
                    <div class="col-xs-4">
                        <div><strong>Q. {{ $bills->sum('total') }}</strong></div>
                        <div><small>Total</small></div>
                    </div><!--/.col-->
                </div><!--/.row-->
                <hr>
                <!--
                <h4><strong>About Karen Boyle</strong></h4>

                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                </p>

                <hr>

                -->

                <h4><strong>Información General</strong></h4>

                <ul class="profile-details">
                    <li>
                        <div><i class="fa fa-briefcase"></i> Sexo</div>
                        @if ($people->gender == 'i')
                            n/a
                        @elseif ($people->gender == 'f')
                            Femenino
                        @elseif ($people->gender == 'm')
                            Masculino
                        @endif
                    </li>
                    <li>
                        <div><i class="fa fa-building-o"></i> Cumpleaños</div>
                        @if ($people->birthday)
                            {{ $people->birthday->format('d/m/y') }}
                        @else
                            n/a
                        @endif
                    </li>
                </ul>

                {{--
                <hr>
                <h4><strong>Información de Contacto</strong></h4>

                <ul class="profile-details">
                    <li>
                        <div><i class="fa fa-phone"></i> Teléfono</div>
                        {{ $people->other_phone }}
                    </li>
                    <li>
                        <div><i class="fa fa-tablet"></i> Celular</div>
                        {{ $people->phone }}
                    </li>
                    <li>
                        <div><i class="fa fa-envelope"></i> e-mail</div>
                        {{ $people->email }}
                    </li>
                    <li>
                        <div><i class="fa fa-map-marker"></i> Dirección</div>
                        {{ $people->address }}
                    </li>
                    <li>
                        <div><i class="fa fa-globe"></i> Website</div>
                        {{ $people->website }}
                    </li>
                </ul>
                 --}}

            </div>

        </div>

    </div><!--/.col-->

    <div class="col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a href="{{ route('bills.store_by_profile', $people) }}" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Facturar</a>
                </div>
                <ul class="nav nav-tabs pull-left" id="tabs">
                    <li><a href="#activity">Intereses</a></li>
                    <li><a href="#contact">Contacto</a></li>
                    <li><a href="#sales">Compras</a></li>
                    <li><a href="#credits">Creditos</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane" id="activity">
                        <div class="row " >
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-original-title="">
                                        <h2><span style="font-size: 1.5em" class="fa fa-gift text-success"></span><span class="break"></span> Intereses Según compras</h2>
                                    </div>
                                    <div class="panel-body">
                                        <ul>
                                            @foreach ($groups as $group)
                                            <li>{{ $group->name }}</li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                            </div><!--/.col-->
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-original-title="">
                                        <h2><span style="font-size: 1.5em" class="fa fa-sun-o text-warning"></span><span class="break"></span> Colores Preferidos</h2>
                                    </div>
                                    <div class="panel-footer">
                                        @foreach ($people->colors as $color)
                                            <span class="fa fa-square" style="color: {{ $color->color }}; font-size: 2em"></span>
                                        @endforeach

                                        <a href="{{ route('people.edit.colors', [$people, $people->slug]) }}" class="btn btn-link"><span class="fa fa-pencil text-success"></span></a>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading"><span style="font-size: 1.5em" class="fa fa-question"></span> Otros</div>
                                    <div class="panel-body">
                                        @foreach ($people->tags as $tag)
                                        <span style="font-size: 1em" class="label label-default">{{ $tag->name }}</span>
                                        @endforeach

                                        <a href="{{ route('people.edit.tags', [$people, $people->slug]) }}" class="btn btn-link"><span class="fa fa-pencil text-success"></span></a>

                                    </div>
                                </div>
                                <!--
                                <div class="panel panel-default">
                                    <div class="panel-heading"><span style="font-size: 1.5em" class="fa fa-magic"></span> Temas</div>
                                    <div class="panel-body">
                                        <span class="label label-default">Elefantes</span>
                                        <span class="label label-default">Hansa</span>
                                        <a href="" class="btn btn-link"><span class="fa fa-pencil text-success"></span></a>
                                    </div>
                                </div>
                                -->
                            </div><!--/.col-->
                        </div><!--/.row-->
                    </div>
                    <div class="tab-pane" id="contact">
                         <div class="row " >
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-original-title="">
                                        <h2>Datos</h2>
                                    </div>
                                    <div class="panel-body">
                                    <ul class="profile-details">
                                        <li>
                                            <div><i class="fa fa-phone"></i> Teléfono</div>
                                            {{ $people->other_phone }}
                                        </li>
                                        <li>
                                            <div><i class="fa fa-tablet"></i> Celular</div>
                                            {{ $people->phone }}
                                        </li>
                                        <li>
                                            <div><i class="fa fa-envelope"></i> e-mail</div>
                                            {{ $people->email }}
                                        </li>
                                        <li>
                                            <div><i class="fa fa-map-marker"></i> Dirección</div>
                                            {{ $people->address }}
                                        </li>
                                        <li>
                                            <div><i class="fa fa-globe"></i> Website</div>
                                            {{ $people->website }}
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div><!--/.col-->
                        </div><!--/.row-->
                    </div>
                    <div class="tab-pane" id="sales">
                        <table class="table col-sm-12">
                            <tr>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Total</th>
                                <th>Vendedor</th>
                                <td></td>
                            </tr>
                            @foreach ($people->purchases as $bill)
                            <tr>
                                <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                                <td>{{ $bill->details->sum('lot') }}</td>
                                <td>Q. {{ $bill->total }}</td>
                                <td>{{ $bill->user->name }}</td>
                                <td><a href="{{ $bill->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="tab-pane" id="credits">
                      <table class="table col-sm-12">
                            <tr>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Abonos</th>
                                <th>Resta</th>
                                <th>Total</th>
                                <th>Vendedor</th>
                                <td></td>
                            </tr>
                            @foreach ($people->credits as $bill)
                            <tr>
                                <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                                <td>{{ $bill->details->sum('lot') }}</td>
                                <td>Q. {{ $bill->payments->sum('amount') }}</td>
                                <td>Q. {{ $bill->total  - $bill->payments->sum('amount') }}</td>
                                <td>Q. {{ $bill->total }}</td>
                                <td>{{ $bill->user->name }}</td>
                                <td><a href="{{ $bill->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

    </div>

</div><!--/.row-->
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            });

            $('#tabs a[href="#activity"]').tab('show')
        });
    </script>
@endsection