@extends('dashboard.dashboard-master')


@section('page_title')
Banner Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('banner.create') }}">Banner</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('banner.create') }}">Banner Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Banner</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Banner Text</h4></label>
                        <input type="text" class="form-control form-control-lg" name="banner_text">
                        {{-- Error Message--}}
                        @error('banner_text') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Banner Title</h4></label>
                        <input type="text" class="form-control form-control-lg" name="banner_title">
                        {{-- Error Message--}}
                        @error('banner_title') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Banner Photo</h4></label>
                        <input type="file" class="form-control form-control-lg" name="banner_photo">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection



