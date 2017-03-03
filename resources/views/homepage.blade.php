


@extends('layouts.app')

@section('content')
    <script>

    </script>

<div class="container my-whole-page">
    <div class="row pl-3">
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
        <div class="container-fluid col-sm-8 col-lg-8">

            <input class="form-control my-input" placeholder="Search..." type="search" id="searchbox">
            <div class="container-fluid filter_res p-sm-3" style="margin: 15px 0 15px 0;">
                <h2 class="title">Search Results</h2>
                <hr>
                <nav class="card">



                    <div id="myTabContent" class="tab-content p-sm-3">


                        <ul class="list-group tab-pane active" id="list" style="margin-top: 10px">
                            @foreach($funds as $fund)
                                <li id="{{$fund->id}}" class="list-group-item my-list fundItem">
                                    <a style="text-decoration: none; color: inherit" data-toggle="collapse" href="#description-{{$fund->id}}" >
                                        <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                                        <span class="list-span">
                                            {{$fund->name}}
                                        </span>
                                    </a>
                                    <div class="collapse pull-right description" id="description-{{$fund->id}}">
                                            {{$fund->farsi}}
                                        <span id="editViewLinks" class="pull-left m-3">
                                          @if(!\Illuminate\Support\Facades\Auth::guest())
                                                <a href="fund/{{$fund->id}}" class="btn btn-sm btn-success ml-1 editLink">Edit</a>
                                            @endif
                                            <a href="fund/{{$fund->id}}" class="btn btn-sm btn-primary pull-left viewLink">View</a>
                                        </span>

                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link">&laquo;</a></li>
                            @foreach($count as $num)
                                <li class="page-item"><a class="page-link">{{$num}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link">&raquo;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('js/my-js1.js')}}"></script>


@endsection