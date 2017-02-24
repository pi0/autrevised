


@extends('layouts.app')

@section('content')


<div class="container my-whole-page">
    <div class="row">
        <div class="container-fluid filter_res col-lg-4 col-sm-4">
            <h2 class="title">Filters</h2>
            <ul class="nav nav-pills flex-column">
                <div class="btn btn-success" id="resetFilters">Reset all</div>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#categoryPan" id="Category">
                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                        <span class="list-span">Category</span>
                    </a>
                </li>
                <div class="collapse" id="categoryPan">
                    <ul class="nav nav-pills flex-column nav-stacked my-stack" id="CategoryFilter">
                        @foreach($categories as $category)
                            <li id="{{$category->id}}">
                                <a class="my-pill nav-link myCategory">{{$category->real}} - {{$category->description}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>


                <li class="nav-item">
                    <a data-toggle="collapse" href="#orgPan"  id="Organization">
                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                        <span class="list-span">Funding Organization</span>
                    </a>
                </li>
                <div class="collapse" id="orgPan">
                    <ul class="nav nav-pills nav-stacked my-stack flex-column" id="OrgFilter">
                        @foreach($organizations as $organization)
                            <li id="{{$organization->id}}">
                                <a class="my-pill nav-link myOrganization">{{$organization->name}} - {{$organization->country->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#countryPan" id="Country">
                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                        <span class="list-span">Country</span>
                    </a>
                </li>
                <div class="collapse" id="countryPan">
                    <ul class="nav nav-pills nav-stacked my-stack flex-column" id="CountryFilter">
                        @foreach($countries as $country)
                            <li id="{{$country->id}}" class="nav-item">
                                <a class="my-pill nav-link myCountry" >{{$country->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#researchPan"  id="Research">
                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                        <span class="list-span">Research Area</span>
                    </a>
                </li>
                <div class="collapse" id="researchPan">
                    <ul class="nav nav-pills flex-column nav-stacked my-stack" id="ResearchFilter">
                        @foreach($fields as $field)
                            <li id="{{$field->id}}">
                                <a class="my-pill nav-link myField">{{$field->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>


            </ul>
        </div>
        <div class="container-fluid col-sm-7 col-lg-7">

            <input class="form-control my-input" placeholder="Search..." type="search" id="searchbox">
            <div class="container-fluid filter_res" style="margin: 15px 0 15px 0;">
                <h2 class="title">Search Results</h2>
                <div class="well">
                    {{--<ul class="nav-tabs nav" id="tabPlace">--}}
                        {{--@foreach($organizations as $org)--}}
                        {{--<li class="tabs-border nav-item tabItem"><a class="my-tabs" href="#{{$org->name}}" aria-expanded="true" data-toggle="tab">{{$org->name}}</a></li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}


                    <div id="myTabContent" class="tab-content">
                        <!--<div class="tab-pane active" id="home">-->
                        <!--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>-->
                        <!--</div>-->

                        <ul class="list-group tab-pane active" id="list" style="margin-top: 10px">
                            @foreach($funds as $fund)
                                <li id="{{$fund->id}}" class="list-group-item my-list fundItem">
                                    <a style="text-decoration: none; color: inherit" data-toggle="collapse" href="#description-{{$fund->id}}" >
                                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                                        <span class="list-span">{{$fund->name}}</span>
                                    </a>
                                    <div class="collapse pull-right description" id="description-{{$fund->id}}">
                                            {{$fund->farsi}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div>
                        <ul class="pagination justify-content-center">
                            <li><a href="#">&laquo;</a></li>
                            @foreach($count as $num)
                                <li><a class="pp">{{$num}}</a></li>
                            @endforeach
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