{!! Field::select('people_id', $providers, ['template' => 'templates.inline']) !!}
<div class="col-md-3">
	<label>Prioridad</label>
</div>
<div class="col-md-9">
    <div class="radio">
        <label>
            <input id="priority_baja" checked="checked" name="priority" type="radio" value="Baja">
            <span class="label label-success">Baja</span>
        </label>
    </div>
    <div class="radio">
        <label>
            <input id="priority_media" name="priority" type="radio" value="Media">
            <span class="label label-warning">Media</span>
        </label>
    </div>
	<div class="radio">
        <label>
            <input id="priority_alta" name="priority" type="radio" value="Alta">
            <span class="label label-danger">Alta</span>
        </label>
    </div>
</div>
{!! Field::hidden('order_type_id', 1) !!}
{!! Field::hidden('commerce_id', $commerce->id) !!}

