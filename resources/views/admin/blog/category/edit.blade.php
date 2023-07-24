{{-- @extends('admin.admin_dashboard')

@section('title', 'Admin')

@section('admin')

@endsection --}}

@extends('admin.admin_dashboard')

@section('title', 'Blog Add Edit')

@section('admin')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blog Edit</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Blog Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

        <div class="col-lg-10">
        <div class="card">
        <div class="card-body">

        <form id="myForm" method="post" action="{{ route('update.blog.category') }}" enctype="multipart/form-data" >
        @csrf

        <input type="hidden" name="id" value="{{ $blogcategoryies->id }}">

        <div class="row mb-3">
        <div class="col-sm-3">
            <h6 class="mb-0">Blog Category Name</h6>
        </div>
        <div class="form-group col-sm-9 text-secondary">
            <input type="text" name="blog_category_name" class="form-control" value="{{ $blogcategoryies->blog_category_name }}"  />
        </div>
        </div>


        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9 text-secondary">
            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    blog_category_name: {
                        required: true,
                    },
                },
                messages: {
                    blog_category_name: {
                        required: 'Please Enter Blog Category Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection


