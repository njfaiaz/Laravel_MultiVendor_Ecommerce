@extends('admin.admin_dashboard')

@section('title', 'Publish Review')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Publish Review List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Publish Review Table</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Comment </th>
                                <th>User </th>
                                <th>Product </th>
                                <th>Rating </th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ Str::limit($item->comment, 25) }}</td>
                                    <td>{{ $item['user']['name'] }}</td>
                                    <td>{{ $item['product']['product_name'] }}</td>
                                    <td>
                                        @if ($item->rating == null)
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                        @elseif($item->rating == 1)
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                        @elseif($item->rating == 3)
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                        @elseif($item->rating == 3)
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                        @elseif($item->rating == 4)
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-secondary"></i>
                                        @elseif($item->rating == 5)
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                        @elseif($item->status == 1)
                                            <span class="badge rounded-pill bg-warning">Publish</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('review.delete', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Comment </th>
                                <th>User </th>
                                <th>Product </th>
                                <th>Rating </th>
                                <th>Status </th>
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
