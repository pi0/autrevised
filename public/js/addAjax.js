/**
 * Created by rajab on 3/2/2017.
 */

$(document).ready(function () {
    $("#catAddButton").click(function () {
        var description = $("#newCatName").val();
        var parent = $("#newCatParent").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/category',
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, description: description, parent: parent, _method: 'PUT'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Category added</strong>',
                    message: 'Category successfully added.'
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
                    title: '<strong>Adding category failed</strong>',
                    message: 'There was an error while adding, try agian.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#addOrgButton").click(function () {
        var name = $("#newOrgName").val();
        var country = $("#newOrgCountry").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/organization',
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, name: name, country: country, _method: 'PUT'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Organization added</strong>',
                    message: 'Organiztion successfully added.'
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
                    title: '<strong>Adding organization failed</strong>',
                    message: 'There was an error while adding, try agian.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#addCountryButton").click(function () {
        var country = $("#newCountryName").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/country',
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, country: country, _method: 'PUT'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Country added</strong>',
                    message: 'Country successfully added.'
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
                    title: '<strong>Adding country failed</strong>',
                    message: 'There was an error while adding, try agian.'
                },{
                    type: 'danger'
                });
            })
    });

    $("#addResearchButton").click(function () {
        var field = $("#newResearchName").val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/field',
            type: 'post',
            dataType: 'html',
            data: {
                _token: CSRF_TOKEN, field: field, _method: 'PUT'
            }
        })
            .done(function (data) {
                $.notify({
                    title: '<strong>Field added</strong>',
                    message: 'Field successfully added.'
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
                    title: '<strong>Adding field failed</strong>',
                    message: 'There was an error while adding, try agian.'
                },{
                    type: 'danger'
                });
            })
    });


});
