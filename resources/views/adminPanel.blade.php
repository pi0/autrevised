@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function () {
            $("#sub").click(function (event) {
                event.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `/adminPanel`,
                    type: 'post',
                    dataType: 'html',
                    data: {
                        _token: CSRF_TOKEN, name: name, email:email, password:password
                    }
                })
                    .done(function (data) {
                        $.notify({
                            title: '<strong>Fund Created</strong>',
                            message: 'Fund successfully created. '+data
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
                            title: '<strong>Fund creation failed</strong>',
                            message: 'There was an error while creating fund, try again.'
                        },{
                            type: 'danger'
                        });
                    })
            });
        });
    </script>



    <div class="container m-4">
        <div class="list-group">
            @foreach($users as $user)
                <div class="list-group-item">{{$user->id}} - {{$user->name}}</div>
            @endforeach
        </div>

        <div class="card p-3">
            <form class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name">

                <label for="email">Email</label>
                <input class="form-control" type="email" id="email">


                <label for="password">password</label>
                <input class="form-control" type="password" id="password">

                <button class="btn btn-info" id="sub">
                    Register
                </button>

            </form>
        </div>
    </div>

@endsection