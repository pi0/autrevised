@extends('layouts.app')

@section('content')
    <ul class="col-sm-6 col-sm-offset-3">
        {{--@foreach($funds as $fund)--}}
            <li><h2>{{ $funds->id }} - {{ $funds->name}}</h2>
                <ul><h3>Category</h3>
                    @foreach($categories as $cat)
                        <li>{{$cat->id}} - {{ $cat->description }}</li>
                    @endforeach
                </ul>
                <ul><h3>Organization</h3>
                    {{--@foreach($organizations as $org)--}}

                        <li>{{$organizations->id}} - {{ $organizations->name }} - {{ $country->name }}</li>
                    {{--@endforeach--}}
                </ul>
                <ul><h3>Fields</h3>
                    @foreach($fields as $field)

                        <li>{{$field->id}} - {{ $field->title }}</li>
                    @endforeach
                </ul>
            </li>

        {{--@endforeach--}}
    </ul>

@endsection