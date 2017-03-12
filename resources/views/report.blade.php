@extends('layouts.app')

@section('content')
    @foreach($funds as $arr)
        @if(!$arr["funds"]->isEmpty() || !$arr["tag"]->children->isEmpty())
            @if($arr["tag"]["is_parent"] && $arr["tag"]->parent_id == 0)
                <div class="jumbotron jumbotron-fluid mb-5 " style="background: #276bb0; color: whitesmoke">
                    <h1 class="align-middle text-center" >
                        {{$arr["tag"]->real}} - {{$arr["tag"]->description}}
                    </h1>
                </div>
            @else
            <div class="container ">
                <div class="card mb-5 bg-success pt-5" style="height: 140px;color: whitesmoke">
                    <h3 class="align-middle text-center" >
                        {{$arr["tag"]->real}} - {{$arr["tag"]->description}}
                    </h3>
                </div>
            </div>
            @endif
                @foreach($arr["funds"] as $tag=>$fund)
                    <style>
                        .btn{
                            border-radius: 25px;
                        }

                        .pageBreak{
                            page-break-after: always;
                            page-break-before: always;
                        }
                    </style>


                    <div class="container mb-5 pageBreak printed">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-title">
                                    {{--<h2 class="justify-content-between">--}}
                                        {{--{{stripslashes($fund->name)}}--}}
                                        {{--@if(Auth::user())--}}
                                            {{--<a class="btn btn-primary pull-right" href="{{url('fund/'.$fund->id)}}">Edit</a>--}}
                                        {{--@endif--}}
                                    {{--</h2>--}}
                                    <div class="row ml-1">
                                        @foreach($fund->tags as $category)
                                            <span class="badge badge-default badge-pill mr-1">{{$category->description}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>

                                <h3 class="pull-left m-2 col-sm-4">
                                    <span class="badge badge-success badge-pill   ml-1">{{$fund->organization->name}}</span>
                {{--                        <span class="badge badge-primary badge-pill  ">{{$organizations->country->name}}</span>--}}
                                    <div class="m-2">
                                        @foreach($fund->fields as $field)
                                            <h4 style="display: inline"><span class="badge badge-default badge-pill mb-1">{{$field->title}}</span></h4>
                                        @endforeach
                                    </div>
                                </h3>


                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="card-text text-justify">
                                                {{stripslashes($fund->description)}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-2">
                                        <div class="card-block">
                                            <div class="card-text text-justify" style="direction: rtl; font-family: Shabnam">
                                                {{stripslashes($fund->farsi)}}
                                            </div>
                                        </div>
                                    </div>
                                    <div id="duration" class="card mt-2">
                                        <div class="row">
                                            <div class="card-block col-sm-11">
                                                <div class="card-text text-justify pl-3">
                                                    {{stripslashes($fund->duration)}}
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <img id="clock" src="{{asset('img/clock.png')}}" width="50px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="financial" class="card mt-2">
                                        <div class="row">
                                            <div class="card-block col-sm-11">
                                                <div class="card-text text-justify pl-3">
                                                    <strong>Financial Support: </strong>{{stripslashes($fund->financial)}}
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <img id="money" src="{{asset('img/money.png')}}" width="50px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="requirements" class="card mt-2">
                                        <div class="row">
                                            <div class="card-block col-sm-11">
                                                <div class="card-text text-justify pl-3">
                                                    <strong>Requirements: </strong>{{stripslashes($fund->requirements)}}
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <img id="cv" src="{{asset('img/cv.png')}}" width="50px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="deadline" class="card mt-2">
                                        <div class="row">
                                            <div class="card-block col-sm-11">
                                                <div class="card-text text-justify pl-3">
                                                    <strong>Deadline: </strong>{{stripslashes($fund->deadline)}}
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <img id="clockfire" src="{{asset('img/deadline2.png')}}" width="50px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="comments" class="card mt-2">
                                        <div class="row">
                                            <div class="card-block col-sm-11">
                                                <div class="card-text text-justify pl-3">
                                                    <strong></strong>{{stripslashes($fund->comments)}}
                                                </div>
                                            </div>
                                            <div class="col-sm-1 mt-2">
                                                <img id="commentIcon" src="{{asset('img/comment.png')}}" width="50px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="text-center col-sm-4 push-sm-4 mt-3" id="links">--}}
                                        {{--@if($fund->link1)--}}
                                            {{--<a target="_blank" href="{{url($fund->link1)}}" class="btn btn-lg btn-success">Link 1</a>--}}
                                        {{--@endif--}}
                                        {{--@if($fund->link2)--}}
                                            {{--<a target="_blank" href="{{url($fund->link2)}}" class="btn btn-lg btn-success">Link 2</a>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
        @endif
    @endforeach
@endsection