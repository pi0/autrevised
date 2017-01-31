


@extends('layouts.app')

@section('content')
<h3>Funds </h3>
<ul>
    @foreach($funds as $fund)
        <li>
            {{$fund->name}}
        </li>
    @endforeach
</ul>

<h3>countries </h3>
<ul>
    @foreach($countries as $country)
        <li>
            {{$country->name}}
        </li>
    @endforeach
</ul>


<h3>Organizations </h3>
<ul>
    @foreach($organizations as $org)
        <li>
            {{$org->name}} - {{$org->country->name}}
        </li>
    @endforeach
</ul>

<h3>Fields </h3>
<ul>
    @foreach($fields as $field)
        <li>
            {{$field->title}}
        </li>
    @endforeach
</ul>


@endsection