@extends('admin.admin_dashboard')

@section('title', 'Profile')

@section('admin')
		<!--start page wrapper -->
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Vendor Active</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Active Vendor Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <form action="{{ route('inactive.vendor.approve') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ActiveVendorDetails->id }}">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">User Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="username" value="{{ $ActiveVendorDetails->username }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"> Vendor Shop Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name" class="form-control" value="{{ $ActiveVendorDetails->name }}"" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Email Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="email" class="form-control" value="{{ $ActiveVendorDetails->email }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Phone No</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="phone" class="form-control" value="{{ $ActiveVendorDetails->phone }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="address" class="form-control" value="{{ $ActiveVendorDetails->address }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Short Info </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <textarea class="form-control" name="vendor_short_info" placeholder="Short Desc......" rows="3">{{ $ActiveVendorDetails->vendor_short_info }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Join Date </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="vendor_join" class="form-control" disabled value="{{ $ActiveVendorDetails->vendor_join }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Vendor Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" name="photo" class="form-control" id="image" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <img src="{{ (!empty($ActiveVendorDetails->photo)) ? url('media/profile/'.$ActiveVendorDetails->photo):url('media/profile/no_image.jpg') }}" alt="Admin" style="width: 100px" height="100px" id="showImage">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-danger px-4" value="In Active Vendor" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!--end page wrapper -->
        @include('admin.alert')
@endsection


