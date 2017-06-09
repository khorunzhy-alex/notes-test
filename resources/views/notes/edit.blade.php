@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Add note</h1>
    </div>

    {!! Form::open(['route' => ['notes.update', $note->id], 'files' => true, 'method' => 'PATCH']) !!}

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
                {!! Form::text('title', $note->title, ['class' => 'form-control']) !!}
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
                {!! Form::textarea('text', $note->text, ['class' => 'form-control']) !!}
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

    <h3>Current images</h3>
    <div class="row">
        @foreach($note->images as $image)
            <div class="col-xs-4">
                <img class="img-responsive" src="{{ asset('uploads/'.$image->image) }}" />
                {!! Form::open(['route' => ['notes.delete_image', $image->id], 'method'=>'DELETE']) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick' => 'return confirm("Delete?") ? true : false;']) !!}
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>
@stop