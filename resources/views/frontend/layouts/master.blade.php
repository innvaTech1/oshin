<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">
    <meta name="author" content="{{ env('APP_AUTHOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon/1.png') }}" type="image/x-icon">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    {{-- Toaster --}}
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">

    <style>
        :root {
            --theme-color: #D2AE71 !important;
            /* Updated color */
            --theme-color-rgb: 8, 79, 177;
            /* Updated RGB values */
            --theme-color1: #D2AE71 !important;
            ;
            /* Updated color */
            --theme-color1-rgb: 8, 79, 177;
            /* Updated RGB values */
            --theme-color2: linear-gradient(90.56deg, var(--theme-color1) 8.46%, var(--theme-color) 62.97%);
        }


        .btn-2-animation::after {
            background: #f1c882 !important;
        }
    </style>
</head>

@include('frontend.partials.header')

@yield('content')

@include('frontend.partials.footer')

<script>
    $(document).ready(function() {
        var cart_items = <?php echo json_encode($cart_items); ?>;

        if (cart_items.length === 0) {
            $('ul.cart-list').append(
                '<li><h5 style="color:#0da487;font-weight:bold; text-align:center">No products in cart</h5></li>'
            );
            $('#cart-total-price').css('display', 'none');
            $('#cart-checkout').css('display', 'none');
        } else {
            $('#cart-count').text(cart_items.length);
            $.each(cart_items, function(index, item) {
                var listItem = $('<li data-cart-delete="' + item.id + '">\
                                    <div class="drop-cart">\
                                        <a class="drop-image" data-slug="' + item.product.slug + '">\
                                            <img src="' + item.product.thumbnail_image_source + '" class="blur-up lazyload cart-product-image" alt="image">\
                                        </a>\
                                        <div class="drop-contain">\
                                            <a data-slug="' + item.product.slug + '">\
                                                <h5 class="cart-product-title">' + item.product.product_name + '</h5>\
                                            </a>\
                                            <h6 class="cart-product-price"><span>' + item.quantity +
                    ' x</span> $100</h6>\
                                            <button class="close-button cart-product-close-btn" style="margin-top:-10px;" data-cart-id="' +
                    item.id + '" data-prod-id="' + item.product.id + '">\
                                                <i class="fa-solid fa-xmark"></i>\
                                            </button>\
                                        </div>\
                                    </div>\
                                </li>');

                // Append the HTML structure to the list
                $('ul.cart-list').append(listItem);
            });
        }

        // Attach click event listener to the delete button
        $('ul.cart-list').on('click', '.cart-product-close-btn', function() {
            var button = $(this);
            var cart_id = button.attr('data-cart-id');
            var prod_id = button.attr('data-prod-id');

            // Send AJAX request to delete item from cart
            $.ajax({
                url: '/cart/delete/' + cart_id,
                type: 'DELETE',
                success: function(response) {
                    toastr.success(response.message);
                    button.closest('li').remove();
                    $('tr[data-cart-delete="' + cart_id + '"]').remove();
                    $('input[data-qty-reset="' + prod_id + '"]').val(0);
                    var divToRemove = $('div[data-removed-from-cart="' + cart_id + '"]');
                    divToRemove.find('input[name="quantity"]').val(0);
                    divToRemove.removeClass('open');

                    $('.compare-btn-add-cart[data-product-id="' + prod_id + '"]').attr(
                        'disabled', false).text('Add to cart');


                    // Update the cart count
                    var cartCount = $('#cart-count').text();
                    if (cartCount > 0) {
                        $('#cart-count').text(cartCount - 1);
                    }
                },
                error: function(error) {
                    toastr.error(error.responseJSON.message);
                }
            });
        });


        // Redirect to product page when the product name is clicked
        $('ul.cart-list').find('a').on('click', function() {
            var item_slug = $(this).attr('data-slug');
            window.location.href = '/product/' + item_slug;
        });
    });
</script>
