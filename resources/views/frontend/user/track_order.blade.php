@extends('frontend.user_dashboard')


@section('title', 'Track Order')

@section('user')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        body {}

        .container {}

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #3BB77E
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #3BB77E;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #3BB77E;
            border-color: #3BB77E;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Track Order Details
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">

                        <!-- // Start Col md 3 menu -->

                        @include('frontend.user.menue')
                        <!-- // End Col md 3 menu -->

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Track Order Details</h5>
                                        </div>
                                        <article class="card">
                                            <header class="card-header"> My Orders / Tracking </header>
                                            <div class="card-body">
                                                <h6>Invoice Number : {{ $track->invoice_no }} </h6>
                                                <article class="card">
                                                    <div class="card-body row">
                                                        <div class="col"> <strong>Order Date:</strong>
                                                            <br>{{ $track->order_date }}
                                                        </div>

                                                        <div class="col"> <strong>Shipping BY:</strong> <br>
                                                            {{ $track->name }} | <i
                                                                class="fa fa-phone"></i>{{ $track->phone }} /
                                                            {{ $track->division->division_name }} /
                                                            {{ $track->district->district_name }} </div>

                                                        <div class="col"> <strong>Payment Method:</strong>
                                                            <br>{{ $track->payment_method }}
                                                        </div>

                                                        <div class="col"> <strong>Total Amount #:</strong>
                                                            <br>${{ $track->amount }}
                                                        </div>
                                                    </div>
                                                </article>
                                                <div class="track">
                                                    @if ($track->status == 'pending')
                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-check"></i> </span> <span
                                                                class="text">Order Pending</span> </div>

                                                        <div class="step"> <span class="icon"> <i
                                                                    class="fa fa-user"></i> </span> <span class="text">
                                                                Order Confirmed</span> </div>

                                                        <div class="step"> <span class="icon"> <i
                                                                    class="fa fa-truck"></i> </span> <span
                                                                class="text">Order Processing </span> </div>

                                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                                                            </span> <span class="text">Delivered </span> </div>
                                                    @elseif($track->status == 'confirm')
                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-check"></i> </span> <span
                                                                class="text">Order Pending</span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-user"></i> </span> <span class="text">
                                                                Order Confirmed</span> </div>

                                                        <div class="step"> <span class="icon"> <i
                                                                    class="fa fa-truck"></i> </span> <span
                                                                class="text">Order Processing </span> </div>

                                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                                                            </span> <span class="text">Delivered </span> </div>
                                                    @elseif($track->status == 'processing')
                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-check"></i> </span> <span
                                                                class="text">Order Pending</span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-user"></i> </span> <span class="text">
                                                                Order Confirmed</span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-truck"></i> </span> <span
                                                                class="text">Order Processing </span> </div>

                                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                                                            </span> <span class="text">Delivered </span> </div>
                                                    @elseif($track->status == 'deliverd')
                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-check"></i> </span> <span
                                                                class="text">Order Pending</span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-user"></i> </span> <span class="text">
                                                                Order Confirmed</span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-truck"></i> </span> <span
                                                                class="text">Order Processing </span> </div>

                                                        <div class="step active"> <span class="icon"> <i
                                                                    class="fa fa-box"></i> </span> <span
                                                                class="text">Delivered </span> </div>
                                                    @endif
                                                </div>

                                                <hr>
                                                <a href="{{ route('user.track.order') }}" class="btn btn-warning"
                                                    data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
                                            </div>
                                        </article>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
