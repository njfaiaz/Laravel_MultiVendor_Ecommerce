{{-- @extends('admin.admin_dashboard')

@section('title', 'Admin')

@section('admin')

@endsection --}}

@extends('admin.admin_dashboard')

@section('title', 'Banner Add ')

@section('admin')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Banner</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Banner Add</li>
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
                            <form id="myForm"  action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Banner Title </h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="banner_title" class="form-control" placeholder="Enter Your Banner Title"/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Banner Url </h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="banner_url" class="form-control" placeholder="Enter Your Banner Url" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Banner Image</h6>
                                        </div>
                                        <div class=" col-sm-9 text-secondary">
                                            <input type="file" name="banner_image" class="form-control" id="image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img src="{{ url('media/profile/no_image.jpg') }}"
                                                alt="Admin" style="width: 100px" height="100px" id="showImage">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Brand" />
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

@section('script')
<script src="{{ asset('admin/assets') }}/js/3.6.0.jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                banner_title: {
                    required : true,
                },
                banner_url: {
                    required : true,
                },
            },
            messages :{
                banner_title: {
                    required : 'Please Enter Banner Title',
                },
                banner_url: {
                    required : 'Please Enter Banner Url',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>



@endsection
