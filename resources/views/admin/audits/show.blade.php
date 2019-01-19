@extends('layouts.base')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <admin-audit audit_id="{{ request()->id }}"></admin-audit>
    </div>
</div>
@stop
