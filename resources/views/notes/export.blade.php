@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Export</h1>
    </div>

    {!! Form::open(['route' => 'export.submit']) !!}

    <div class="row">
        <div class="col-xs-12">
            {!! Form::submit('Export', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                {!! Form::label('type','Format') !!}
                {!! Form::select('type', ['xml' => 'XML', 'txt' => 'TXT'], ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop