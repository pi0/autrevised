@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        @foreach($countries as $country)
            <li>{{ $country->id }} - {{ $country->name }}</li>
        @endforeach
    </ul>
    <form action="/country" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="text" id="country" name="country">
    </form>

@endsection