


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


<div class="container my-whole-page">
    <div class="row">
        <div class="container-fluid filter_res col-lg-4 col-sm-4">
            <h2 class="title">Filters</h2>
            <ul class="panel-group">
                <li class="list-group-item side-list">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Category</span>
                </li>
                <li class="list-group-item side-list">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Funding Organization</span>
                </li>

                <li>
                    <a data-toggle="collapse" href="#countryPan" class="list-group-item side-list" id="Country">
                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                        <span class="list-span">Country</span>
                    </a>
                </li>
                <div class="panel-collapse collapse" id="countryPan">
                    <ul class="list-group nav nav-pills nav-stacked my-stack" id="CountryFilter" style="display: none">
                        @foreach($countries as $country)
                            <li id="{{$country->id}}">
                                <a class="my-pill" href="#">{{$country->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <li data-toggle="collapse" href="#resPan" class="list-group-item side-list" id="ResearchArea">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Research Area</span>


                </li>
                <div class="panel-collapse collapse" id="resPan">
                    <ul class="list-group nav nav-pills nav-stacked my-stack" id="ResearchAreaOpen" style="display: none">
                        @foreach($fields as $field)
                            <li id="{{$field->id}}" class="list-group-item">
                                <a class="my-pill" href="#">{{$field->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </ul>
        </div>
        <div class="container-fluid col-sm-7 col-lg-7">

            <input class="form-control my-input" placeholder="Search..." type="search">
            <div class="container-fluid filter_res" style="margin: 15px 0 15px 0;">
                <h2 class="title">Search Results</h2>
                <div class="well">
                    <ul class="nav-tabs nav">
                        <li class="tabs-border"><a class="my-tabs" href="#home" aria-expanded="true" data-toggle="tab">DAAD</a></li>
                        <li class="tabs-border"><a class="my-tabs" href="#profile" data-toggle="tab">Fraunhofer</a></li>
                        <li class="tabs-border"><a class="my-tabs" href="#" data-toggle="tab">AVH</a></li>
                        <li class="tabs-border"><a class="my-tabs" href="#" data-toggle="tab">MPG</a></li>
                        <li class="tabs-border"><a class="my-tabs" href="#" data-toggle="tab">Test</a></li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <!--<div class="tab-pane active" id="home">-->
                        <!--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>-->
                        <!--</div>-->

                        <ul class="list-group tab-pane active" style="margin-top: 10px">
                            <li class="list-group-item my-list">
                                <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                                <span class="list-span">Study Visits by Groups of Foreign Students</span>
                            </li>
                            <li class="list-group-item my-list">
                                <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                                <span class="list-span">Re-invitation programme for former scholarship holders</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('js/my-js1.js')}}"></script>


@endsection