@extends('layouts.base')

@section('content')
    @php
        $alto=6;
        $ancho=6;
    @endphp
    <table class="table table-bordered text-center">
        <a href="#" class="btn btn-primary hidden-print btn-lg btn-print" title="Imprimir" onclick="window.print()">
            <span class="fa fa-2x fa-print"></span>
        </a>
        @for ($i = 0; $i< $alto; $i++)
        <tr>
            @for ($j = 0; $j < $ancho; $j++)
            <td style="background-color: white" class="text-center">

                <br>
                @if ($commerce->logo_path)
                    <img src="{{  route('commerces.logo', $commerce) }} " alt="" class="img-rounded" width="75">
                @endif
                <br>
                <br>
                <p style="margin: 0px 0 1px;">{{ $product->name }}</p>
                <p style="margin: 0px 0 1px;">{{ $product->unit->name }}</p>
                <p style="margin: 0px 0 1px;"><strong>Normal Q. {{ $product->price }} </strong></p>
                <p style="background-color: red; background-image: url('/img/paper.gif'); margin: 0px 0 1px;"><strong>Descuento Q. {{ $product->offer_price }} </strong></p>
                <p style="margin: 0px 0 1px;">ID: {{ $product->id }}</p>
                <p style="margin: 0px 0 1px;" class="text-center">
                    <div class="bcTarget text-center">
                        {{ $product->barcode }}
                    </div>
                </p>
            </td>
            @endfor
        </tr>
        @endfor
    </table>
@endsection

@section('scripts')
    {!! Html::script('js/jquery-barcode.min.js') !!}
    <script>
        //window.print();
        $(".bcTarget").barcode("{{ $product->barcode }}", "code39", {barWidth:1});
    </script>
@endsection
