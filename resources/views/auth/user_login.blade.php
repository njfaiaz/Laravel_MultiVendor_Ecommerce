<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Login</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets') }}/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/main.css?v=5.3" />
</head>

<body>


    <!-- Quick view -->
    @include('frontend.body.quickview')
    <!-- Header  -->
        @include('frontend.body.header')


    <!--End header-->

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{ asset('frontend/assets') }}/imgs/page/login-1.png" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5"> User Login</h1>
                                            <p class="mb-30">Don't have an account? <a href="{{ route('user.register') }}">Create here</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}" class="row g-3">
                                            @csrf
                                            <div class="form-group">
                                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Your Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" @error('password') is-invalid @enderror" name="password" required
                                                    id="inputChoosePassword"
                                                    placeholder="Enter Password">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{ asset('frontend/assets') }}/js/plugins/wow.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/plugins/waypoints.js"></script>
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
</body>

</html>
