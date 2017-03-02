/**
 * Created by ASUS on 2/2/2017.
 */

document.filters = {
    $org_ids: [],
    $field_ids: [],
    $tag_ids: [],
    $country_ids: [],
    $ratings: []
};



$(document).ready(function () {
   document.fundItem = $('.fundItem')[0];
   document.tabItem = $('.tabItem')[0];
   console.log(document.fundItem);
   console.log(document.tabItem);

   document.offset = 0;
});


$("[data-toggle *= 'collapse']").click(function(){
    if ($(this).find("i").hasClass("fa-caret-right")){
        $(this).find("i").removeClass("fa-caret-right");
        $(this).find("i").addClass("fa-caret-down");
    }
    else{
        $(this).find("i").removeClass("fa-caret-down");
        $(this).find("i").addClass("fa-caret-right");
    }
});

$(".my-pill").click(function () {
    var myID = parseInt($(this).parent().attr('id'));
    document.offset = 0;
    console.log(myID);
    if (!$(this).hasClass("active")){
        if($(this).hasClass("myCategory")){
            document.filters.$tag_ids.push(myID);
        } else if($(this).hasClass("myField")){
            document.filters.$field_ids.push(myID);
        } else if($(this).hasClass("myCountry")){
            document.filters.$country_ids.push(myID);
        } else if($(this).hasClass("myOrganization")){
            document.filters.$org_ids.push(myID);
        }
        $(this).addClass("active");
    }
    else {
        if($(this).hasClass("myCategory")){
            var index = document.filters.$tag_ids.indexOf(myID);
            if(index > -1)
                document.filters.$tag_ids.splice(index, 1);
        } else if($(this).hasClass("myField")){
            var index = document.filters.$field_ids.indexOf(myID);
            if(index > -1)
                document.filters.$field_ids.splice(index, 1);
        } else if($(this).hasClass("myCountry")){
            var index = document.filters.$country_ids.indexOf(myID);
            if(index > -1)
                document.filters.$country_ids.splice(index, 1);
        } else if($(this).hasClass("myOrganization")){
            var index = document.filters.$org_ids.indexOf(myID);
            if(index > -1)
                document.filters.$org_ids.splice(index, 1);
        }
        $(this).removeClass("active");
    }
    console.log(document.filters);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/search',
        type: 'post',
        dataType: 'html',
        data: {_token: CSRF_TOKEN, filter: document.filters, offset: document.offset
        }
    })
        .done(function(data) {
            console.log('success');
            refreshFunds(data);
        })
        .fail(function() {
            console.log("error");

        })

});


$("#searchbox").on('keypress', function (event) {
    document.offset = 1;
   if(event.which == 13)
   {
       event.preventDefault();
       var filter = $(this).val();
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
           url: '/search',
           type: 'post',
           dataType: 'html',
           data: {_token: CSRF_TOKEN, filter: filter, offset: document.offset
           }
       })
           .done(function(data) {
              console.log('success');

           })
           .fail(function() {
               console.log("error");

           })
           .always(function() {

           });
   }
});

$(".page-link").on('click', onPage);

function onPage(event) {
    event.preventDefault();
    document.offset = parseInt($(this).html())-1;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/search',
        type: 'post',
        dataType: 'html',
        data: {
            _token: CSRF_TOKEN, filter: document.filters, offset: document.offset
        }
    })
        .done(function (data) {
            console.log('success');
            refreshFunds(data);
        })
        .fail(function () {
            console.log("error");

        })
}

function refreshFunds(res) {
    var tmp = jQuery.parseJSON(res);
    var data = tmp.result;
    var count = tmp.count/5;
    $('#list').empty();
    // var d = jQuery.parseJSON(data);
    for(var i=0; i<data.length; i++) {
        var el = data[i];
        var item = $(document.fundItem).clone();
        $(item).find('span').html(el.name);
        $(item).find('a').attr('href','#description-' + el.id);
        $(item).find('div').attr('id', 'description-' + el.id);
        var editLink  = $(item).find("div a");
        $(item).find('div').text(el.farsi);
        editLink.attr('href','fund/'+el.id);
        $(item).find('div').append(editLink);
        $('#list').append(item);
    }

    $('.pagination').empty();
    for(var u=0; u<=count; u++){
        var page = $('<li class="page-item"><a class="page-link"></a></li>');
        $(page).find('a').html(u+1);
        $(page).find('a').on('click', onPage);
        $('.pagination').append(page);
    }

    $("#list").collapse();

}
