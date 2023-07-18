<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

        @yield('main')

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


</body>

</html>
