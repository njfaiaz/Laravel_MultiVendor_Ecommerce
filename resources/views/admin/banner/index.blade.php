@extends('admin.admin_dashboard')

@section('title', 'All Banner')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Banner</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Banner Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('banner.add') }}" class="btn btn-primary">Add Banner</a>
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
                                <th>Banner Title</th>
                                <th>Banner Url</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->banner_title }}</td>
                                <td>{{ $item->banner_url }}</td>
                                <td>
                                    <img src="{{ asset( $item->banner_image ) }}" style="width: 70px; height:40x;" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('banner.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('banner.delete',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SI</th>
                                <th>Banner Title</th>
                                <th>Banner Url</th>
                                <th>Banner Image</th>
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
