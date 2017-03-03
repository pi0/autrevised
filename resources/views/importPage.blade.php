@extends('layouts.app')

@section('content')

    <div class="container align-content-center">

        <div class="list-group card">
            <h2 class="list-group-item active mb-4">
                Import Funds
            </h2>
            <form action="/import" method="POST" enctype="multipart/form-data" class="form-group">
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
                    <button type="submit" class="btn btn-lg btn-success mt-4">
                        Import
                    </button>
                </div>

            </form>
        </div>

    </div>


@endsection