<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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







    <footer class="main">
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

  {{-- -------------------------------  Quickview with ajax view with id ------------------- --}}

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('centent')
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
        }
    </script>
</body>

</html>
