@extends('dashboard.dashboard-master')

@section('page_title')
Banner List
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('banner.create') }}">Banner</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('banner.index') }}">Banner List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List of Categories</h3>
            </div>
            @if (session('update_msg'))
                <div class="alert alert-primary">
                    {{ session('update_msg') }}
                </div>
            @endif
            @if (session('img_up_msg'))
                <div class="alert alert-primary">
                    {{ session('img_up_msg') }}
                </div>
            @endif
            @if (session('soft_delete_msg'))
                <div class="alert alert-warning">
                    {{ session('soft_delete_msg') }}
                </div>
            @endif
            @if (session('hard_delete_msg'))
                <div class="alert alert-danger">
                    {{ session('hard_delete_msg') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Banner Title</h4></th>
                            <th><h4>Banner Text</h4></th>
                            <th><h4>Banner Photo</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $banners as $banner )
                            <tr>
                                <td>{{$banner->banner_title}}</td>
                                <td>{{$banner->banner_text}}</td>
                                <td class="w-50">
                                    <img class="w-25" src="{{ asset('uploads/banner') }}/{{ $banner->banner_photo }}" alt="not found">
                                </td>
                                <td>
                                    --
                                </td>
                            </tr>
                            @empty
                                <tr class="text-danger text-center">
                                    <td colspan="50">No Data To Show!</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

