$(document).ready(function() {
    function addToShoppingCart(ticket) {
        $.ajax({
            type: "POST",
            url: '../../BLL/ShoppingCart.php',
            data: 'img='+encodeURIComponent(ticket), // the product image as a parameter
            dataType: 'json',   // expecting json
            success: function (msg) {
            }
        });
    }
});