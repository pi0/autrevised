@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        @foreach($organizations as $org)
            <li>{{ $org->id }} - {{ $org->name}} - {{ $org->country['name'] }}</li>
        @endforeach
    </ul>
    <form action="/organization" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="text" id="name" name="name">
        <select name="country" id="country">
            @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </select>
    </form>

@endsection