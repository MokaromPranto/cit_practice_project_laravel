@extends('dashboard.dashboard-master')

@section('page_title')
Category Details
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category List</a></li>
        <li class="breadcrumb-item active"><a href="">Category Details</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Category Details</h3>
            </div>
            <div class="row">
                <div class="col-8 p-3">
                    <div class="row">
                        <div class="col-4 p-3 text-center">
                            <img src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="not found">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <p><span class="h4">Category ID : </span>{{ $category->id }}</p>
                                <p><span class="h4">Category Name : </span>{{ $category->category_name }}</p>
                                <p><span class="h4">Created At : </span>{{ $category->created_at->diffforhumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>

@endsection




