@extends('layouts.app')

@section('content')

<div class="container my-whole-page">
    <div class="row">
        <div class="container-fluid filter_res col-lg-4 col-sm-4">
            <h2 class="title">Filters</h2>
            <ul class="list-group">
                <li class="list-group-item side-list">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Category</span>
                </li>
                <li class="list-group-item side-list">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Funding Organization</span>
                </li>
                <li class="list-group-item side-list">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Country</span>
                </li>
                <li class="list-group-item side-list" id="ResearchArea">
                    <i class="fa fa-caret-right" style="font-size: 25px" aria-hidden="true"></i>
                    <span class="list-span">Research Area</span>


                </li>
                <ul class="list-group-item nav nav-pills nav-stacked my-stack" id="ResearchAreaOpen" style="display: none">
                    <li id="All"><a class="my-pill" href="#">All</a></li>
                    <li id="Aerospace"><a class="my-pill" href="#">Aerospace</a></li>
                    <li id="Electrical"><a class="my-pill" href="#">Electrical</a></li>
                </ul>
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
