$(document).ready(function(){

    $("#performersButton").click(function(){
        $("#lineup ").css("display", "none");
        $("#allPerformers ").css("display", "inline");
    });

    $("#mainHeader button").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#ticketOverzicht").offset().top
        }, 500);
    });
    $("#eventButtons button").click(function() {
        $("#dateButtons").css("display","block");
        $(this).removeClass("bigButton").addClass("invertedBigButton")
    });
    $("#dateButtons button").click(function() {
        $("#tickets").css("display","block");
        $(this).removeClass("bigButton").addClass("invertedBigButton")
    });
});