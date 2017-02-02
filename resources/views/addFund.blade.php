@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        @foreach($funds as $fund)
            <li>{{ $fund->id }} - {{ $fund->name}} </li>
        @endforeach
    </ul>
    <form action="/fund" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group col-sm-12">
            <label for="name">name</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="form-group col-sm-12">
            <label for="rating">rating</label>
            <input type="number" class="form-control" id="rating" name="rating">
        </div>
        <div class="form-group col-sm-12">
            <label for="farsi">farsi</label>
            <input type="text" class="form-control" id="farsi" name="farsi">
        </div>
        <div class="form-group col-sm-12">
            <label for="description">description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <select name="organization" id="organization" class="form-control col-sm-12">
                @foreach($organizations as $organization)
                    <option value="{{$organization->id}}">{{$organization->name}} - {{ $organization->country['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="fields[]" id="fields" multiple class="form-control col-sm-12">
                @foreach($fields as $field)
                    <option value="{{$field->id}}">{{$field->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="categories[]" id="categories" multiple class="form-control col-sm-12">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                    @if(!empty($category->children->all()))
                        disabled
                    @endif
                        >{{$category->description}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn" value="submit">
    </form>

@endsection