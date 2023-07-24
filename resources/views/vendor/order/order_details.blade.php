@extends('vendor.vendor_dashboard')

@section('title', 'Order Details')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />

        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col">
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
            <div class="col">
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
                                <th><span class="badge bg-info bg-danger" style="font-size: 15px;">{{ $order->status }}</span></th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
            <div class="col">
                <div class="card">
                    <div class=" pt-50 pb-50 text-center">
                        <h1 style="background-color: #F4F6FA"> Product Details</h1>
                    </div>
                    <div class="row g-0">
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
                                                        style="width:50px; height:50px;"> </label>
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
                                                <label>${{ $item->price }} <br> Total = ${{ $item->price * $item->qty }}
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @include('admin.alert')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
