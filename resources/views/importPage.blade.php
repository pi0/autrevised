@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Import page</h1>
    </div>
    <form action="/import" method="POST" enctype="multipart/form-data" class="col-sm-4 col-sm-offset-4">
        {{--{{ method_field('PUT') }}--}}
        {{ csrf_field() }}
        <div class="form-group col-sm-12">
            <label for="f">File</label>
            <input class="form-control" type="file" id="f" name="f">
        </div>
        <div class="form-group col-sm-12">
            <label for="name">Name</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="form-group col-sm-12">
            <label for="organization">Organization</label>
            <select class="form-control" name="organization" id="organization">
                @foreach($organizations as $org)
                    <option value="{{$org->id}}">{{$org->name}} - {{$org->country['name']}}</option>
                @endforeach
            </select>
        </div>
    </form>

@endsection