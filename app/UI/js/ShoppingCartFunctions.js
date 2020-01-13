$(document).ready(function() {
    function addToShoppingCart(ticket) {
        $.ajax({
            type: "POST",
            url: '../../BLL/ShoppingCart.php',
            data: 'ticket='+encodeURIComponent(ticket),
            dataType: 'json',
            success: function (msg) {
            }
        });
    }
});