@extends('layouts.app')

@section('content')
    <ul class="list-group col-sm-6 col-sm-offset-3">
        @foreach($categories as $category)
            <li id="{{$category->id}}" class="list-group-item justify-content-between">
                <h4 style="display: inline">{{ $category->id }} - {{ $category->description}} - {{ $category->parent_id }} - {{ $category->real }}</h4>
                    <button role="delete" data-content="{{$category->id}}" class="btn btn-sm btn-danger pull-right">delete</button>
                    <button role="addChild" data-content="{{$category->id}}" class="btn btn-sm btn-success pull-right">Add Child</button>
                <p>
                    {{$category}}
                </p>
            </li>
        @endforeach
    </ul>


    <form action="/category" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="text" id="description" name="description">
        <select name="parent" id="parent">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->description}}</option>
            @endforeach
        </select>
    </form>

    <script>
        $("[role = 'delete']").on('click', function (event) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-content');
            $.ajax({
                url: '/category/'+id,
                type: 'post',
                dataType: 'html',
                data: {_token: CSRF_TOKEN, _method: 'delete'}
            })
                .done(function(data) {
                    window.location.reload();
                });
        });
        
        $("[role = 'addChild']").on('click', function (event) {
            var inputGetter = $('<div class="row col-sm-10 col-sm-offset-1"><input id="addChildSubmit" class="form-control col-sm-8" placeholder="Child\'s Name" autofocus><a class="btn btn-sm btn-success" id="ADD">Add</a></div>')
            if($(this).parent().find('input').length == 0){
                $(inputGetter).insertAfter(this);
                $('#ADD').on('click', ADDCHILD);
                $('#ADD').on('keypress', ADDCHILD);
                $('#ADD').focus();
            }
        });



        function ADDCHILD(event) {
            event.preventDefault();
            if(event.keyCode && event.keyCode==13)
                return;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $('#ADD').parent().attr('data-content');
            var parentId = $('#ADD').parent().parent().attr('id');
            var description = $('#ADD').parent().parent().find('input').val();
            $.ajax({
                url: '/category',
                type: 'post',
                dataType: 'html',
                data: {_token: CSRF_TOKEN, _method: 'put', parent: parentId, description: description}
            })
                .done(function(data) {
                    window.location.reload();
                });
        }
    </script>

@endsection