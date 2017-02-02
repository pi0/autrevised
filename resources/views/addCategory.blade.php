@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        @foreach($categories as $category)
            <li>{{ $category->id }} - {{ $category->description}} - {{ $category->parent_id }} - {{ $category->real }} </li>
        @endforeach
    </ul>
    <form action="/category" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="text" id="description" name="description">
        <select name="parent" id="parent">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->description}}</option>
            @endforeach
        </select>
    </form>

@endsection