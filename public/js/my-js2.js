/**
 * Created by ASUS on 2/3/2017.
 */
$("#category").click(function(){
    if ($("#category i").hasClass("fa-caret-right")){
        $("#category i").removeClass("fa-caret-right");
        $("#category i").addClass("fa-caret-down");
    }
    else{
        $("#category i").removeClass("fa-caret-down");
        $("#category i").addClass("fa-caret-right");
    }
    $("#categoryOpen").toggle();
});

$("#fundOrg").click(function(){
    if ($("#fundOrg i").hasClass("fa-caret-right")){
        $("#fundOrg i").removeClass("fa-caret-right");
        $("#fundOrg i").addClass("fa-caret-down");
    }
    else{
        $("#fundOrg i").removeClass("fa-caret-down");
        $("#fundOrg i").addClass("fa-caret-right");
    }
    $("#fundOrgOpen").toggle();
});

$("#country").click(function(){
    if ($("#country i").hasClass("fa-caret-right")){
        $("#country i").removeClass("fa-caret-right");
        $("#country i").addClass("fa-caret-down");
    }
    else{
        $("#country i").removeClass("fa-caret-down");
        $("#country i").addClass("fa-caret-right");
    }
    $("#countryOpen").toggle();
});