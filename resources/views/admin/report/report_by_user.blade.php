@extends('admin.admin_dashboard')

@section('title', 'User Report')

@section('admin')



<link href="{{ asset('admin/assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('admin/assets') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Report</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report Page</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />

        <form method="post" action="{{ route('search-by-user') }}">
            @csrf
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Search By User</h5>

                        <div class="mb-3">
                            <label class="form-label">Select2 Text Control</label>
                            <select name="user" class="single-select">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach


                            </select>
                        </div>


                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>


                </div>
            </div>
        </form>


	<script src="{{ asset('admin/assets') }}/js/jquery.min.js"></script>
	<script src="{{ asset('admin/assets') }}/plugins/select2/js/select2.min.js"></script>
	<script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

	</script>


        {{-- <form method="post" action="{{ route('search-by-user') }}">
            @csrf
            <div class="col">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Search By User</h5>

                        <label class="form-label">Select User:</label>
                        <select name="user" class="form-select mb-3" aria-label="Default select example">
                            <option selected="">Open this select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>


                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>


                </div>
            </div>
        </form> --}}
    </div>

    @include('admin.alert')
    </div>
@endsection


