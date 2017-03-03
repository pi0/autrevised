@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function () {
            $("#addOrgButton").click(function (event) {
                event.preventDefault();
                var name = $("#newOrgName").val();
                var country = $("#newOrgCountry").val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/organization',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        _token: CSRF_TOKEN, name: name, country: country, _method: 'PUT'
                    }
                })
                    .done(function (data) {
                        $.notify({
                            title: '<strong>Organization added</strong>',
                            message: 'Organiztion successfully added.'
                        },{
                            type: 'success'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    })
                    .fail(function () {
                        console.log("error");
                        $.notify({
                            title: '<strong>Adding organization failed</strong>',
                            message: 'There was an error while adding, try agian.'
                        },{
                            type: 'danger'
                        });
                    })
            });

            $("#addCountryButton").click(function (event) {
                event.preventDefault();
                var country = $("#newCountryName").val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/country',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        _token: CSRF_TOKEN, country: country, _method: 'PUT'
                    }
                })
                    .done(function (data) {
                        $.notify({
                            title: '<strong>Country added</strong>',
                            message: 'Country successfully added.'
                        },{
                            type: 'success'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    })
                    .fail(function () {
                        console.log("error");
                        $.notify({
                            title: '<strong>Adding country failed</strong>',
                            message: 'There was an error while adding, try agian.'
                        },{
                            type: 'danger'
                        });
                    })
            });


        });


    </script>

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
                    <hr class="mt-4">
                    <h3>Add new organization</h3>
                    <div class="form-group">
                        <label class="control-label" for="newOrgName">Name:</label>
                        <input type="text" class="form-control" id="newOrgName" placeholder="For example DAAD, MPG">
                        <label class="control-label" for="newOrgCountry">Country:</label>
                        <select class="List js-states form-control" style="width: 100%" id="newOrgCountry">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">
                                    {{$country->name}}
                                </option>
                            @endforeach
                        </select>

                        <div class="text-center">
                            <button id="addOrgButton" class="btn btn-success my-btn" style="margin: 15px 0 5px 0;" type="submit">Add</button>
                        </div>
                    </div>

                    <hr class="mt-4">
                    <h3>Add new Countries</h3>
                    <div class="form-group">
                        <label class="control-label" for="newCountryName">Name:</label>
                        <input type="text" class="form-control" id="newCountryName" placeholder="For example Germany, France">
                        <div class="text-center">
                            <button id="addCountryButton" class="btn btn-success my-btn" style="margin: 15px 0 5px 0;" type="submit">Add</button>
                        </div>
                    </div>




                    <button type="submit" class="btn btn-lg btn-success mt-4">
                        Import
                    </button>
                </div>

            </form>
        </div>

    </div>


@endsection