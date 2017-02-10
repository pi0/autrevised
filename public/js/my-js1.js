/**
 * Created by ASUS on 2/2/2017.
 */
$("[data-toggle *= 'collapse']").click(function(){
    if ($(this).find("i").hasClass("fa-caret-right")){
        $(this).find("i").removeClass("fa-caret-right");
        $(this).find("i").addClass("fa-caret-down");
    }
    else{
        $(this).find("i").removeClass("fa-caret-down");
        $(this).find("i").addClass("fa-caret-right");
    }
    // $(this).find("i").toggle();
});

// $("#All").click(function () {
//     if ($("#All").hasClass("active")){
//         $("#ResearchAreaOpen li").each(function() {
//             $(this).removeClass("active");
//         });
//     }
//     else {
//         $("#ResearchAreaOpen li").each(function() {
//             $(this).addClass("active");
//         });
//     }
// });
//
// $("#Aerospace").click(function () {
//     $("#All").removeClass("active");
//     $(this).toggleClass("active");
// });
//
// $("#Electrical").click(function () {
//     $("#All").removeClass("active");
//     $(this).toggleClass("active");
// });