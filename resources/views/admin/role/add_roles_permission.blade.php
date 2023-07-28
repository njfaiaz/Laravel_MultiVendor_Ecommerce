@extends('admin.admin_dashboard')

@section('title', 'Role & Permission Add ')

@section('admin')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role & Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role & Permission</li>
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

                                <form id="myForm" method="post" action="{{ route('role.permission.store') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Roles Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="role" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefaultAll">
                                        <label class="form-check-label" for="flexCheckDefaultAll">Permission All</label>
                                    </div>

                                    <hr>
                                    @foreach ($permission_groups as $group)
                                        <div class="row">
                                            <!--  // Start row  -->
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label"
                                                        for="flexCheckDefault">{{ $group->group_name }}</label>
                                                </div>
                                            </div>

                                            <div class="col-9">

                                                @php
                                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                                @endphp

                                                @foreach ($permissions as $permission)
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="permission[]" type="checkbox"
                                                            value="{{ $permission->id }}"
                                                            id="flexCheckDefault{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                @endforeach
                                                <br>
                                            </div>

                                        </div><!--  // end row  -->
                                    @endforeach

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


    <script src="{{ asset('admin/assets') }}/js/3.6.0.jquery.min.js"></script>
    <script type="text/javascript">
        $('#flexCheckDefaultAll').click(function() {
            if ($(this).is(':checked')) {
                $('input[type = checkbox]').prop('checked', true);
            } else {
                $('input[type = checkbox]').prop('checked', false);
            }
        });
    </script>
@endsection
