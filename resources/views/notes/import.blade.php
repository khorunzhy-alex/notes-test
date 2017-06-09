@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Import</h1>
    </div>

    {!! Form::open(['route' => 'import.submit', 'files' => true]) !!}

    <div class="row">
        <div class="col-xs-12">
            {!! Form::submit('Import', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                {!! Form::label('file','Select file (XML or TXT)') !!}
                {!! Form::file('file', ['class' => 'form-control']) !!}
                @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop