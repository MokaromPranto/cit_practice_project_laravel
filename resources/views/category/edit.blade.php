@extends('dashboard.dashboard-master')


@section('page_title')
Category Edit
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category List</a></li>
        <li class="breadcrumb-item active"><a href="">Category Edit</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="form-group input-primary">
                        <label><h4>Category Name</h4></label>
                        <input value="{{ $category->category_name }}" type="text" class="form-control form-control-lg" name="category_name">
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Old Category Image</h4></label>
                        <p><img class="w-25" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="Not Found"></p>
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>New Category Photo</h4></label>
                        <input type="file" class="form-control form-control-lg" name="category_photo">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-arrow-up text-primary"></i>
                        </span>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

