@extends('frontend.user_dashboard')


@section('title', 'Account Details')

@section('user')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> User Account
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
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>User Name</label>
                                                        <input  class="form-control" name="username" type="text" disabled value="{{ $userData->username }}" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>User Full Name :<span class="required">*</span></label>
                                                        <input  class="form-control" name="name" type="text" value="{{ $userData->name }}"/>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Phone Number : <span class="required">*</span></label>
                                                        <input  class="form-control" name="phone" type="text" value="{{ $userData->phone }}"/>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Emain Address : <span class="required">*</span></label>
                                                        <input  class="form-control" name="email" type="email" value="{{ $userData->email; }}"/>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label> Address : <span class="required">*</span></label>
                                                        <textarea class="form-control" name="address" placeholder="Short Desc......" rows="3">{{ $userData->address }}</textarea>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label> Photo : <span class="required">*</span></label>
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="file" name="photo" class="form-control" id="image" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="col-sm-9 text-secondary">
                                                            <img src="{{ (!empty($userData->photo)) ? url('media/profile/'.$userData->photo):url('media/profile/no_image.jpg') }}" alt="Admin" style="width: 100px" height="100px" id="showImage">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
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
        </div>
    </div>

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
