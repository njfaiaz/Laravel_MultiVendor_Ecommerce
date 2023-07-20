<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets') }}/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/main.css?v=5.3" />
    <title> @yield('title')</title>
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
        @include('frontend.body.quickview')
    <!-- Header  -->
        @include('frontend.body.header')

    <!-- End Header  -->


    <main class="main">

        @yield('user')

    </main>







    <footer class="main-footer">
        @include('frontend.body.footer')
    </footer>



    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets') }}/imgs/theme/loading.gif" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets') }}/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/slick.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/waypoints.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/wow.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/counterup.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/images-loaded.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/isotope.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/scrollup.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets') }}/js/main.js?v=5.3"></script>
    <script src="{{ asset('frontend/assets') }}/js/shop.js?v=5.3"></script>
    <script src="{{ asset('frontend/assets/sweetalert2@11') }}"></script>
  {{-- -------------------------------  Quickview with ajax view with id ------------------- --}}

    <script>
        // Model view With Ajax ------------------------------------------------
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })

        function productView(id){ //productView muloto ze page er view hobe oi page er id
            $.ajax({
                type: 'GET',
                url: 'product/view/model/'+id,
                dataType: 'json',
                success: function(data){
                    $('#pname').text(data.product.product_name);
                    $('#pprice').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name); // category beshi mane ralationship er jonno
                    $('#pbrand').text(data.product.brand.brand_name); // category beshi mane ralationship er jonno
                    $('#pimage').attr('src','/'+data.product.product_thumbnail);
                    $('#product_id').val(id);
                    $('#qty').val(1);

                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    }

                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('aviable');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    }

                    $('select[name="size"]').empty();
                    $.each(data.size,function(key,value){
                        $('select[name="size"]').append('<option value="'+value+' ">'+value+' </option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    })

                    $('select[name="color"]').empty();
                    $.each(data.color,function(key,value){
                        $('select[name="color"]').append('<option value="'+value+' ">'+value+' </option>')
                        if (data.color == "") {
                            $('#colorArea').hide();
                        } else {
                            $('#colorArea').show();
                        }
                    })
                }
            })
        } // End Product View

        // Start Add to Cart Product ----------------------------------------------

        function addToCart(){
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();

            $.ajax({
                type : "POST",
                dataType : 'json',
                data:{
                    product_name:product_name, color:color, size:size, quantity:quantity
                },
                url: 'cart/data/store/'+id,
                success:function(data){
                    miniCart();
                    $('#closeModal').click();

                    // ----------- sweetalert2@11 Message Alert ----------------------
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            });
        } // End Add to cart


        // Start Details Page Add to Cart Product ----------------------------------------------

        function addToCartDetails(){
            var product_name = $('#dpname').text();
            var id = $('#dproduct_id').val();
            var color = $('#dcolor option:selected').text();
            var size = $('#dsize option:selected').text();
            var quantity = $('#dqty').val();

            $.ajax({
                type : "POST",
                dataType : 'json',
                data:{
                    product_name:product_name, color:color, size:size, quantity:quantity
                },
                url: 'cartDetails/data/store/'+id,
                success:function(data){
                    miniCart();

                    // ----------- sweetalert2@11 Message Alert ----------------------
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            });
        } // End Add to cart

    </script>

{{-- Start Add to Small Cart Product Add view ---------------------------------------------- --}}
    <script>
        function miniCart(){
            $.ajax({
                type: 'GET',
                url: 'product/mini/cart',
                dataType: 'json',
                success:function(response){
                    // $('#cartQty').text(response.cartQty);
                    $('span[id="cartQty"]').text(response.cartQty);
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    // $('#cartSubTotal').text(response.cartTotal);
                    var miniCart = ""
                    $.each(response.carts, function(key, value){
                        miniCart +=

                        `
                            <ul>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html"><img alt="Nest"
                                                src="/${value.options.image}" style="width:50px;height:50px;"/></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                        <h4><span>${value.qty} × </span>${value.price}</h4>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                            </ul>
                            <hr><br>
                        `
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }

        miniCart();

        // mini cart remove ------------------------------------------------------
        function miniCartRemove(rowId){
            $.ajax({
                type: 'GET',
                url: 'miniCart/product/remove/'+rowId,
                dataType: 'json',
                success:function(data){
                    miniCart();
                        // ----------- sweetalert2@11 Message Alert ----------------------
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            })
        }


    </script>

    {{-- Add to Wishlist Data Store -------------------------------------------------------------- --}}
    <script>
        function addToWishlist(product_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "add-to-wishlist/"+product_id,

                success:function(data){
                    wishlist();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                icon: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            })
        }
    </script>
    {{-- Add to Wishlist Data View Page -------------------------------------------------------------- --}}
    <script>
        function wishlist(){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "get-wishlist-product/",

                success:function(response){
                    $('#wishQty').text(response.wishQty);
                    var rows = ""
                    $.each(response.wishlist, function(key, value){
                        rows += `
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                            </td>
                            <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">

                                ${value.product.discount_price == null
                                ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                                :`<h3 class="text-brand">$${value.product.discount_price}</h3>`
                                }

                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                ${value.product.product_qty > 0
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span> `
                                : `<span class="stock-status out-stock mb-0">  Stock Out</span> `
                                }

                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>
                        `
                    });
                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();


        // wishlist Remove ---------------------------------------
        function wishlistRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "wishlistRemove/"+id,

                success:function(data){
                    wishlist();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                icon: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            })
        }



    </script>

    {{-- Add to Compare Data Store -------------------------------------------------------------- --}}
    <script>
        function addToCompare(product_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "add-to-compare/"+product_id,

                success:function(data){
                    compare();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                icon: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            })
        }
    </script>

    {{-- Add to Compare Data View Page -------------------------------------------------------------- --}}
    <script>
        function compare(){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "get-compare-product/",

                success:function(response){
                    $('#compQty').text(response.compQty);
                    var rows = ""
                    $.each(response.compare, function(key, value){
                        rows +=
                        `
                        <tr class="pr_image">
                            <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                            <td class="row_img"><img src="/${value.product.product_thumbnail}" alt="compare-img" style="width:300px;height:300px;"/></td>
                        </tr>
                        <tr class="pr_title">
                            <td class="text-muted font-sm fw-600 font-heading">Name</td>
                            <td class="product_name">
                                <h6><a href="shop-product-full.html" class="text-heading" ${value.product.product_name}></a></h6>
                            </td>
                        </tr>
                        <tr class="pr_price">
                            <td class="text-muted font-sm fw-600 font-heading">Price</td>
                            <td class="product_price">
                                ${value.product.discount_price == null
                                ? `<h4 class="price text-brand">$${value.product.selling_price}</h4>`
                                :`<h4 class="price text-brand">$${value.product.discount_price}</h4>`
                                }
                            </td>
                        </tr>
                        <tr class="description">
                            <td class="text-muted font-sm fw-600 font-heading">Description</td>
                            <td class="row_text font-xs">
                                <p class="font-sm text-muted">${value.product.short_disc}</p>
                            </td>
                        </tr>
                        <tr class="pr_stock">
                            <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                            <td class="row_stock">
                                ${value.product.product_qty > 0
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span> `
                                : `<span class="stock-status out-stock mb-0">  Stock Out</span> `
                                }

                            </td>
                        </tr>
                        <tr class="pr_remove text-muted">
                            <td class="text-muted font-md fw-600"></td>
                            <td class="row_remove">
                                <a type="submit" class="text-muted" id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                            </td>
                        </tr>
                        `
                    });
                    $('#compare').html(rows);
                }
            })
        }
        compare();


        // Compare Remove ---------------------------------------
        function compareRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "compareRemove/"+id,

                success:function(data){
                    compare();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                                Toast.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: data.success,
                                })
                        }else{

                        Toast.fire({
                                type: 'error',
                                icon: 'error',
                                title: data.error,
                                })
                        } //Message End
                }
            })
        } // End Remove
    </script>

{{-- Start Add to Cart Page ---------------------------------------------- --}}
<script>
    function cart(){
        $.ajax({
            type: 'GET',
            url: 'get-cart-product',
            dataType: 'json',
            success:function(response){
                var rows = ""
                $.each(response.carts, function(key, value){
                    rows +=

                    `
                    <tr class="pt-30">
                            <td class="custome-checkbox pl-30">

                            </td>
                            <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name}</a></h6>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">$${value.price} </h4>
                            </td>
                            <td class="price" data-title="Price">
                                ${value.options.color == null
                                    ? `<span>......</span>`
                                    : `<h4 class="text-body">${value.options.color} </h4>`
                                }

                            </td>
                            <td class="price" data-title="Price">
                                ${value.options.size == null
                                    ? `<span>......</span>`
                                    : `<h4 class="text-body">${value.options.size} </h4>`
                                }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink mr-15">
                                    <div class="detail-qty border radius">


                                        <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>

                                        <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">

                                        <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand">$${value.subtotal} </h4>
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a type="submit" class="text-body" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a>
                            </td>

                        </tr>
                    `
                });
                $('#cartPage').html(rows);
            }
        })
    }

    cart();

    // mini cart remove ------------------------------------------------------
    function cartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: 'cartRemove/'+rowId,
            dataType: 'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })
                    }else{

                    Toast.fire({
                            type: 'error',
                            title: data.error,
                            })
                    } //Message End
            }
        })
    }

    // Cart Page Cart Decrement ------------------------------------------------------
    function cartDecrement(rowId){
        $.ajax({
            type: 'GET',
            url: "cart-decrement/"+rowId,
            dataType: 'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }
    // Cart Page Cart Increment ------------------------------------------------------
    function cartIncrement(rowId){
        $.ajax({
            type: 'GET',
            url: "cart-increment/"+rowId,
            dataType: 'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }


</script>


<script>
    // Apply Coupon Script ----------------------------------------------------------------------------

    function applyCoupon(){
    var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {coupon_name:coupon_name},
                url: "coupon-apply",
                success:function(data){
                    couponCalculation();

                    if (data.validity == true) {
                        $('#couponField').hide();
                    }

                     // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',

                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

           Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
              // End Message
                }
            })
        } // End Apply

    // Total Subtotal Script ----------------------------------------------------------------------------
    function couponCalculation(){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'coupon-calculation',
            success:function(data){
                if (data.total) {
                    $('#couponCalField').html(
                        `
                        <tr>
                            <td class="cart_total_label">
                                <h6 class="text-muted">Subtotal</h6>
                            </td>
                            <td class="cart_total_amount">
                                <h4 class="text-brand text-end">$${data.total}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart_total_label">
                                <h6 class="text-muted">Grand Total</h6>
                            </td>
                            <td class="cart_total_amount">
                                <h4 class="text-brand text-end">$${data.total}</h4>
                            </td>
                        </tr>
                        `
                    )
                } else {
                    $('#couponCalField').html(
                        `
                        <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$${data.subtotal}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class=fi-rs-trash></i></a></h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Discount Amount</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$${data.discount_amount}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$${data.total_amount}</h4>
                                </td>
                            </tr>
                        `
                    )
                }
            }
        })
    }
    couponCalculation();

    // Coupon remove ------------------------------------------------------
    function couponRemove(){
        $.ajax({
            type: 'GET',
            url: 'couponRemove',
            dataType: 'json',
            success:function(data){
                couponCalculation();
                $('#couponCalField').show();
                    // ----------- sweetalert2@11 Message Alert ----------------------
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })
                    }else{

                    Toast.fire({
                            type: 'error',
                            title: data.error,
                            })
                    } //Message End
            }
        })
    }
</script>


</body>

</html>
