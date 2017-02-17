<div id="field_{{ $id }}"{!! Html::classes(['form-group row', 'has-danger' => $hasErrors]) !!}>
    <label for="{{ $id }}" class="col-md-3 form-control-label" for="hf-email">
    	{{ $label }}
    </label>
    <div class="col-md-9">
        {!! $input !!}
        @foreach ($errors as $error)
            <p class="help-block">{{ $error }}</p>
        @endforeach
        @if ($required)
	        <span class="badge badge-info">Obligatorio</span>
	    @endif
    </div>
</div>