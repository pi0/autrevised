@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
{{--        @foreach($funds as $fund)--}}
            <li>{{ $fund->id }} - {{ $fund->name}} </li>
        {{--@endforeach--}}
    </ul>
    <form action="/fund/1" method="POST" class="col-sm-4 col-sm-offset-4">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group col-sm-12">
            <label for="name">name</label>
            <input class="form-control" type="text" id="name" name="name" value="{{$fund->name}}">
        </div>
        <div class="form-group col-sm-12">
            <label for="rating">rating</label>
            <input type="number" class="form-control" id="rating" name="rating" value="{{$fund->rating}}">
        </div>
        <div class="form-group col-sm-12">
            <label for="farsi">farsi</label>
            <input type="text" class="form-control" id="farsi" name="farsi" value="{{$fund->farsi}}">
        </div>
        <div class="form-group col-sm-12">
            <label for="description">description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{$fund->description}}">
        </div>
        <div class="form-group">
            <select name="organization" id="organization" class="form-control col-sm-12">
                @foreach($organizations as $organization)
                    <option value="{{$organization->id}}"
                    @if($organization->id == $fund->organization_id)
                        selected = "selected"
                    @endif
                    >{{$organization->name}} - {{ $organization->country['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="fields[]" id="field" multiple class="form-control col-sm-12">
                @foreach($fields as $field)
                    <option value="{{$field->id}}"
                    @if($fund->fields->contains('id', $field->id))
                        selected = "selected"
                    @endif
                    >{{$field->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="categories[]" id="category" multiple class="form-control col-sm-12">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                    @if(!empty($category->children->all()))
                        disabled
                    @endif
                    @if($fund->tags->contains('id', $category->id))
                        selected = "selected"
                    @endif
                        >{{$category->description}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" id="subbut" class="btn" value="submit">
    </form>

    <script >
        $('input,select').on('change',function(event){
            var field_name = $(this).attr('id');
            var field_value = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/fund/1",
                type: 'post',
                dataType: 'html',
                data: {
                    _token: CSRF_TOKEN, field_name: field_name, value: field_value, _method: 'PATCH'
                }
            })
                .done(function (data) {
                    location.reload();
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {

                });
        });

    </script>
@endsection