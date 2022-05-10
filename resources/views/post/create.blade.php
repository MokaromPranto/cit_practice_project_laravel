@extends('dashboard.dashboard-master')


@section('page_title')
Post Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('post.create') }}">Post</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('post.create') }}">Post Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Post</h3>
            </div>
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Post Title</h4></label>
                        <input type="text" class="form-control" name="post_title">
                        {{-- Error Message--}}
                        @error('post_title') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Post Description</h4></label>
                        <textarea class="form-control"  name="post_des" rows="5"></textarea>
                        {{-- Error Message--}}
                        @error('post_des') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Choose Image</h4></label>
                        <input type="file" class="form-control" name="post_image">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

