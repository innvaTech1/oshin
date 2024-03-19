/**=====================
     Quantity 2 js
==========================**/
$(document).on('click',".addcart-button",function () {
    $(this).next().addClass("open");
    // $(".add-to-cart-box .qty-input").val("1");
});

$(document).on("click",".add-to-cart-box", function () {
    var $qty = $(this).siblings(".qty-input");
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
    }
});

$(document).on("click",".qty-left-minus", function () {
    var $qty = $(this).siblings(".qty-input");
    var _val = $($qty).val();
    if (_val == "1") {
        var _removeCls = $(this).parents(".cart_qty");
        $(_removeCls).removeClass("open");
    }
});

// add to cart
$(document).on("click",".btn-add-cart", function (e) {
    e.preventDefault();
    // Get the product ID from the data-product-id attribute
    var productId = $(this).data("product-id");
    // Get the quantity from the input field
    var quantity = $(this).closest('.add-to-cart-box').find('input[name="quantity"]').val(1);
    // Perform an AJAX POST request
    callAddToCart(productId, 1, "ADD");
});

// Increase quantity
$(document).on("click",".qty-right-plus", function (e) {
    e.preventDefault();
    var productId = $(this).data("product-id");
    var input = $(this).prev('input[name="quantity"]');
    var newValue = parseInt(input.val()) + 1;
    input.val(newValue);
    // Perform an AJAX POST request
    callAddToCart(productId, newValue, "INC");
});

// Decrease quantity
$(document).on("click",".qty-left-minus", function (e) {
    e.preventDefault();
    var productId = $(this).data("product-id");
    var input = $(this).next('input[name="quantity"]');
    var newValue = parseInt(input.val()) - 1;
    if (newValue >= 0) {
        input.val(newValue);
        // Perform an AJAX POST request
        callAddToCart(productId, newValue, "DEC");
    }
});
