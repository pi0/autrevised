@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        @foreach($fields as $field)
            <li>{{ $field->id }} - {{ $field->title}}</li>
        @endforeach
    </ul>
    <form action="/field" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="text" id="field" name="field">
    </form>

@endsection