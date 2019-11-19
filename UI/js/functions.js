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
  
});