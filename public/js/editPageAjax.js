/**
 * Created by rajab on 3/2/2017.
 */
$(document).ready(function () {


    $("#deleteButton").click(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: window.location,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, _method: 'DELETE'
            }
        })
            .done(function (data) {
                window.location.href = '/homepage';
            })
            .fail(function () {
                $.notify({
                    title: '<strong>Delete Error</strong>',
                    message: 'There was an error while deleting, try again.'
                },{
                    type: 'danger'
                });
            })
    });




    $(".field").on('change',function(event){
        var field_name = $(this).attr('id');
        var field_value = $(this).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: window.location,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, field_name: field_name, value: field_value, _method: 'PATCH'
            }
        })
            .done(function (data) {
                if(data != 'no'){
                    $.notify({
                        title: '<strong>Update Succusful</strong>',
                        message: 'Fund was successfully updated.'
                    },{
                        type: 'success'
                    });
                } else {
                    $.notify({
                        title: '<strong>Update Error</strong>',
                        message: 'This field cannot be empty!'
                    },{
                        type: 'danger'
                    });
                }

            })
            .fail(function () {
                console.log("error");
                $.notify({
                    title: '<strong>Update Error</strong>',
                    message: 'There was an error while updating, try again.'
                },{
                    type: 'danger'
                });
            })
            .always(function () {

            });
    });


})
