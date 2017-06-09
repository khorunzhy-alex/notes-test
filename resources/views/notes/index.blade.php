@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h1>Notes</h1>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-primary" href="{{ route('notes.create') }}">Add note</a>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Text</th>
                        <th>Images</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notes as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n->title }}</td>
                        <td>{!! str_limit($n->text, $limit = 200, $end = '...') !!}</td>
                        <td>
                            @foreach($n->images as $img)
                                <img src="{{ asset('uploads/'.$img->image) }}" style="max-width: 100px; max-height: 100px;" />
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('notes.edit', ['id' => $n->id]) }}" class="btn btn-info">Edit</a>
                            {!! Form::open(['route' => ['notes.destroy', $n->id], 'method'=>'DELETE']) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick' => 'return confirm("Delete?") ? true : false;']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No results</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop