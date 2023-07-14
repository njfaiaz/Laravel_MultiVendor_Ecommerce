@extends('admin.admin_dashboard')

@section('title', 'All Slider')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Slider</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Slider Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('slider.add') }}" class="btn btn-primary">Add Slider</a>
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
                                <th>Slidr Title</th>
                                <th>Slider Short Title</th>
                                <th>Slider Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->slider_title }}</td>
                                <td>{{ $item->slider_short_title }}</td>
                                <td>
                                    <img src="{{ asset( $item->slider_image ) }}" style="width: 70px; height:40x;" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('slider.delete',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SI</th>
                                <th>Slidr Title</th>
                                <th>Slider Short Title</th>
                                <th>Slider Image</th>
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
