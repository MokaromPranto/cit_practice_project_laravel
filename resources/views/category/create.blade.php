@extends('dashboard.dashboard-master')


@section('page_title')
Category Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('category.create') }}">Category</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('category.create') }}">Category Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category</h3>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Category Name</h4></label>
                        <input type="text" class="form-control form-control-lg" name="category_name">
                    </div>
                    {{-- Error Message--}}
                    @error('category_name') <span class="badge badge-danger mb-3">{{ $message }}</span> @enderror
                    <div class="form-group input-primary">
                        <label><h4>New Category Photo</h4></label>
                        <input type="file" class="form-control form-control-lg" name="category_photo">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
