@extends('admin.admin_dashboard')

@section('title', 'All Coupon')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('coupon.add') }}" class="btn btn-primary">Add Coupon</a>
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
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupon as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->coupon_name }}</td>
                                <td>{{ $item->coupon_discount }}%</td>
                                <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D,d F Y')  }}</td>
                                <td>
                                    @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge rounded-pill bg-success"> Valid</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger"> Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('coupon.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('coupon.delete',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SI</th>
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
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
