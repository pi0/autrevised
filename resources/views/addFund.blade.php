@extends('layouts.app')

@section('content')
    <script>

        $(document).ready(function () {
            $("#newFund").click(function () {
                var name = $("#name").val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `/newFund`,
                    type: 'post',
                    dataType: 'html',
                    data: {
                        _token: CSRF_TOKEN, name: name
                    }
                })
                    .done(function (data) {
                        $.notify({
                            title: '<strong>Fund Created</strong>',
                            message: 'Fund successfully created.'
                        },{
                            type: 'success'
                        });
                        setTimeout(function () {
                            window.location.href = `/fund/${data}`;
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


    <div class="container" style="height: 70vh">
        <div class="card p-0 mt-4 list-group" style="top: 30%">
            <h3 class="list-group-item active m-0">New Fund</h3>
            <div class="p-4 text-center">
                <h4 class="text-left">Enter a name for your new fund</h4>
                <input class="form-control" id="name" placeholder="Name">
                <button id="newFund" class="btn btn-success btn-lg mt-4">Let's Go!</button>
            </div>
        </div>
    </div>
@endsection