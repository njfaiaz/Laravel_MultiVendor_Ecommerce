@extends('vendor.vendor_dashboard')

@section('title', 'All Product')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Product <span class="badge rounded-pill bg-danger">{{ count($products) }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('vendor.product.add') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Qty</th>
                                <th>Product Discount</th>
                                <th>Product Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>
                                    <img src="{{ asset( $item->product_thumbnail ) }}" style="width: 70px; height:40x;" alt="">
                                </td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->product_qty }}</td>
                                <td>
                                    @if ($item->discount_price  == NULL)
                                        <span class="badge rounded-pill bg-info"> No Discount</span>
                                    @else
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price) * 100;
                                        @endphp
                                        <span class="badge rounded-pill bg-danger"> {{ round($discount) }} %</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                    <span class="badge rounded-pill bg-success"> Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger"> InActive</span>
                                    @endif

                                <td>
                                    <a href="{{ route('vendor.product.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('category.delete',$item->id) }}" id="delete" class="btn btn-warning">Details</a>
                                     <a href="{{ route('vendor.product.delete',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>


                                     @if ($item->status == 1)
                                     <a href="{{ route('vendor.product.inactive',$item->id) }}" id="deleteInactive" class="btn btn-success">Active</a>
                                    @else
                                    <a href="{{ route('vendor.product.active',$item->id) }}" id="deleteactive" class="btn btn-danger">InActive</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SI</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Qty</th>
                                <th>Product Discount</th>
                                <th>Product Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.alert')
    </div>
@endsection
