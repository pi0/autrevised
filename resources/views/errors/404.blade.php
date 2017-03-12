@extends('layouts.app')

@section('content')

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}

    <style>
        html, body {
            height: 100%;
        }

        /*.container {*/
            /*text-align: center;*/
            /*display: table-cell;*/
            /*vertical-align: middle;*/
        /*}*/

        /*.content {*/
            /*text-align: center;*/
            /*display: inline-block;*/
        /*}*/

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>

    <div class="container align-center ">
        <div class="content mt-5">
            <div class="title text-center">404 - Page not found</div>
        </div>
    </div>
@endsection
