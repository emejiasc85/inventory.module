@extends('layouts.base') @section('content')
<!-- {{$alto=20}}
{{$ancho=6}} -->
<table class="text-center">
    <tr>
        <th>
        </th>
    </tr>
    <a href="#" class="btn btn-primary hidden-print btn-lg btn-print" title="Imprimir" onclick="window.print()">
        <span class="fa fa-2x fa-print"></span>
    </a>
    @for ($i = 0; $i
    < $alto; $i++) <tr>
        @for ($j = 0; $j
        < $ancho; $j++) <td>
            <div class="bcTarget">
                {{ $product->barcode }}
            </div>
            </td>
            @endfor
            </tr>
            @endfor
</table>
@endsection @section('scripts') {!! Html::script('js/jquery-barcode.min.js') !!}
<script>
window.print();
$(".bcTarget").barcode("{{ $product->barcode }}", "codabar");
</script>
@endsection
