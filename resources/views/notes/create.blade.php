@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Add note</h1>
    </div>

    {!! Form::open(['route' => 'notes.store', 'files' => true]) !!}

    <div class="row">
        <div class="col-xs-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a class="btn btn-default" href="{{ route('notes.index') }}">Cancel</a>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title','Title') !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group  {{ $errors->has('text') ? ' has-error' : '' }}">
                {!! Form::label('text','Text') !!}
                {!! Form::textarea('text', old('text'), ['class' => 'form-control']) !!}
                @if ($errors->has('text'))
                    <span class="help-block">
                        <strong>{{ $errors->first('text') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                {!! Form::label('images','Images (multiple)') !!}
                {!! Form::file('images[]', ['multiple' => true, 'accept'=>'image/*']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop