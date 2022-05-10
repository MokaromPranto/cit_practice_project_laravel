@extends('dashboard.dashboard-master')

@section('page_title')
Product List
@endsection()


@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.create') }}">Product</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Product List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: block">
                <div class="row">
                    <div class="col-10">
                        <h3>List of Products</h3>
                    </div>
                    <div class="col-2">
                        <form action="" method="GET">
                            <div class="form-group input-primary">
                                <select name="category_id" class="form-control form-control-lg" onchange="this.form.submit()">
                                    <option value="">-Filter By Category-</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <th><h4>Product Name</h4></th>
                            <th><h4>Product Category</h4></th>
                            <th><h4>Product Subcategory</h4></th>
                            <th><h4>Product Photo</h4></th>
                            <th><h4>Product Regular Price</h4></th>
                            {{-- <th><h4>Product SKU(Barcode)</h4></th> --}}
                            {{-- <th><h4>Product SKU(Qrcode)</h4></th> --}}
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $products as $product )
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>
                                    {{$product->relationwithcategory->category_name}}
                                </td>
                                <td>
                                    {{$product->relationwithsubcategory->subcategory_name}}
                                </td>
                                <td>
                                    <img class="w-25" src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_photo }}" alt="not found">
                                </td>
                                <td>{{$product->product_regular_price}}</td>
                                {{-- <td>{!! DNS1D::getBarcodeSVG($product->product_sku, 'C39') !!}</td> --}}
                                {{-- <td>{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE', 3,3,'blue') !!}</td> --}}
                                <td>
                                    <a href="{{ route('product.inventory', $product->id) }}" class="btn btn-secondary btn-sm">Inventory</a>
                                    <a href="{{ route('product.add.gallery', $product->id) }}" class="btn btn-info btn-sm">Gallery</a>
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

