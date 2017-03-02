/**
 * Created by rajab on 3/2/2017.
 */


$(document).ready(function () {
    $("#catEditButton").click(function () {
        var catId = $("#catIdEdit").val();
        var description = $("#catNewName").val();
        var parent = $("#catNewParent").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/category/${catId}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, description: description, parent: parent, _method: 'PATCH'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Category Updated</strong>',
                    message: 'Category successfully updated.'
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
                    title: '<strong>Updating category failed</strong>',
                    message: 'There was an error while updating, try agian.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#orgEditButton").click(function () {
        var id = $("#orgIdEdit").val();
        var name = $("#orgNewName").val();
        var country = $("#orgNewCountry").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/organization/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, name: name, country: country, _method: 'PATCH'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Organization Updated</strong>',
                    message: 'Organization successfully updated.'
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
                    title: '<strong>Updating organization failed</strong>',
                    message: 'There was an error while updating, try agian.'
                },{
                    type: 'danger'
                });
            })
    });


    $("#editCountryButton").click(function () {
        var id = $("#countryIdEdit").val();
        var country = $("#countryNewName").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/country/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, country: country, _method: 'PATCH'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Country Updated</strong>',
                    message: 'Country successfully updated.'
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
                    title: '<strong>Updating country failed</strong>',
                    message: 'There was an error while updating, try agian.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#editFieldButton").click(function () {
        var id = $("#fieldIdEdit").val();
        var field = $("#fieldNewName").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/field/${id}`,
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, field: field, _method: 'PATCH'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Field Updated</strong>',
                    message: 'Field successfully updated.'
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
                    title: '<strong>Updating field failed</strong>',
                    message: 'There was an error while updating, try agian.'
                },{
                    type: 'danger'
                });
            })
    });


});
