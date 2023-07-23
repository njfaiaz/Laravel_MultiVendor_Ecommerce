@extends('frontend.user_dashboard')


@section('title', 'All Order Details')

@section('user')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> User Order Page
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Shipping Details</h4>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                <tr>
                                                    <th>Shipping Name:</th>
                                                    <th>{{ $order->name }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Shipping Phone:</th>
                                                    <th>{{ $order->phone }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Shipping Email:</th>
                                                    <th>{{ $order->email }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Shipping Address:</th>
                                                    <th>{{ $order->adress }}</th>
                                                </tr>


                                                <tr>
                                                    <th>Division:</th>
                                                    <th>{{ $order->division->division_name }}</th>
                                                </tr>

                                                <tr>
                                                    <th>District:</th>
                                                    <th>{{ $order->district->district_name }}</th>
                                                </tr>

                                                <tr>
                                                    <th>State :</th>
                                                    <th>{{ $order->state->state_name }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Post Code :</th>
                                                    <th>{{ $order->post_code }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Order Date :</th>
                                                    <th>{{ $order->order_date }}</th>
                                                </tr>

                                            </table>

                                        </div>

                                    </div>
                                </div>
                                <!-- // End col-md-6  -->

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Order Details
                                                <span class="text-danger">Invoice : {{ $order->invoice_no }} </span>
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                <tr>
                                                    <th> Name :</th>
                                                    <th>{{ $order->user->name }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Phone :</th>
                                                    <th>{{ $order->user->phone }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Payment Type:</th>
                                                    <th>{{ $order->payment_method }}</th>
                                                </tr>


                                                <tr>
                                                    <th>Transx ID:</th>
                                                    <th>{{ $order->transaction_id }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Invoice:</th>
                                                    <th class="text-danger">{{ $order->invoice_no }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Order Amonut:</th>
                                                    <th>${{ $order->amount }}</th>
                                                </tr>

                                                <tr>
                                                    <th>Order Status:</th>
                                                    <th><span
                                                            class="badge rounded-pill bg-warning">{{ $order->status }}</span>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- // End col-md-6  -->

                            </div><!-- // End Row  -->
                        </div>
                        <!-- // End Col md 9  -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class=" pt-50 pb-50 text-center">
                <h1 style="background-color: #F4F6FA">My Product Details</h1>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" style="font-weight: 600;">
                        <tbody>
                            <tr>
                                <td class="col-md-1">
                                    <label>Image </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Name </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Vendor Name </label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Code </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Color </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Size </label>
                                </td>
                                <td class="col-md-1">
                                    <label>Quantity </label>
                                </td>

                                <td class="col-md-3">
                                    <label>Price </label>
                                </td>

                            </tr>

                            @foreach ($orderItem as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label><img src="{{ asset($item->product->product_thumbnail) }}"
                                                style="width:75px; height:75px;"> </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_name }}</label>
                                    </td>
                                    @if ($item->vendor_id == null)
                                        <td class="col-md-2">
                                            <label>Owner </label>
                                        </td>
                                    @else
                                        <td class="col-md-2">
                                            <label>{{ $item->product->vendor->name }} </label>
                                        </td>
                                    @endif

                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_code }} </label>
                                    </td>
                                    @if ($item->color == null)
                                        <td class="col-md-1">
                                            <label>.... </label>
                                        </td>
                                    @else
                                        <td class="col-md-1">
                                            <label>{{ $item->color }} </label>
                                        </td>
                                    @endif

                                    @if ($item->size == null)
                                        <td class="col-md-1">
                                            <label>.... </label>
                                        </td>
                                    @else
                                        <td class="col-md-1">
                                            <label>{{ $item->size }} </label>
                                        </td>
                                    @endif
                                    <td class="col-md-1">
                                        <label>{{ $item->qty }} </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label>Price =${{ $item->price }} <br> Total = ${{ $item->price * $item->qty }}
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                   <!--  // Start Return Order Option  -->
            <div class=" pt-50 pb-50 text-center ">
                @if($order->status !== 'deliverd')

                @else
                @php
                    $order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                @endphp

                    @if($order)
                        <form action="{{ route('return.order',$order->id) }}" method="post">
                            @csrf
                            <h1 style="background-color: #F4F6FA">Order Return Reason</h1><br><br>
                                <textarea name="return_reason" class="form-control" placeholder="Enter Your Product Return Reason"></textarea><br>
                            <button type="submit" class="btn-sm btn-danger">Order Return</button>
                        </form>
                    @else

                        <h2><span class=" " style="color:red;">You have send return request for this product</span></h2><br><br>
                    @endif
                @endif
            </div>



            </div>
        </div>
    </div>
<!-- Textarea 2 rows height -->

@endsection
