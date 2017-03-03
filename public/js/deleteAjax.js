/**
 * Created by rajab on 3/2/2017.
 */



$(document).ready(function () {
    $("#catDeleteButton").click(function () {
        var catId = $("#catIdDelete").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/category/${catId}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN,  _method: 'DELETE'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Category Deleted</strong>',
                    message: 'Category successfully deleted.'
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
                    title: '<strong>Deleting category failed</strong>',
                    message: 'There was an error while deleting, try again.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#orgDeleteButton").click(function () {
        var id = $("#orgIdDelete").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/organization/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN,  _method: 'DELETE'
            }
        })
            .done(function (data) {
                if(data == 'no'){
                    $.notify({
                        title: '<strong>Deleting organization failed</strong>',
                        message: 'This organization cannot be deleted because it has some funds attached to it.'
                    },{
                        type: 'danger'
                    });
                } else {
                    $.notify({
                        title: '<strong>organization Deleted</strong>',
                        message: 'Organization successfully deleted.'
                    },{
                        type: 'success'
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            })
            .fail(function () {
                console.log("error");
                $.notify({
                    title: '<strong>Deleting organization failed</strong>',
                    message: 'There was an error while deleting, try again.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#deleteCountryButton").click(function () {
        var id = $("#countryIdDelete").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/country/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN,  _method: 'DELETE'
            }
        })
            .done(function (data) {
                if(data == 'no'){
                    $.notify({
                        title: '<strong>Deleting country failed</strong>',
                        message: 'This country cannot be deleted because it has some funds attached to it.'
                    },{
                        type: 'danger'
                    });
                } else {
                    $.notify({
                        title: '<strong>Country Deleted</strong>',
                        message: 'Country successfully deleted.'
                    },{
                        type: 'success'
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            })
            .fail(function () {
                console.log("error");
                $.notify({
                    title: '<strong>Deleting country failed</strong>',
                    message: 'There was an error while deleting, try again.'
                },{
                    type: 'danger'
                });
            })
    });


    $("#deleteFieldButton").click(function () {
        var id = $("#fieldIdDelete").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/field/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN,  _method: 'DELETE'
            }
        })
            .done(function (data) {
                if(data == 'no'){
                    $.notify({
                        title: '<strong>Deleting field failed</strong>',
                        message: 'This field is attached to other funds, you cannot delete it.'
                    },{
                        type: 'danger'
                    });
                } else{
                    $.notify({
                        title: '<strong>Field Deleted</strong>',
                        message: 'Field successfully deleted.'
                    },{
                        type: 'success'
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            })
            .fail(function () {
                console.log("error");
                $.notify({
                    title: '<strong>Deleting country failed</strong>',
                    message: 'There was an error while deleting, try again.'
                },{
                    type: 'danger'
                });
            })
    });


});
