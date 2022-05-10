@extends('dashboard.dashboard-master')


@section('page_title')
Gallery Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Product</a></li>
        <li class="breadcrumb-item active"><a href="">Gallery Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Gallery Photo to <span class="text-success h3">{{$product_id->product_name}}</span></h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('product.add.gallery.store' , $product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Choose Gallery Photo</h4></label>
                        <input type="file" class="form-control form-control-lg" name="gallery_photo[]" multiple>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Gallery Photos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection





