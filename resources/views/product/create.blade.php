@extends('dashboard.dashboard-master')


@section('page_title')
Product Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.create') }}">Product</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.create') }}">Product Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add product</h3>
            </div>
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Product Name</h4></label>
                        <input type="text" class="form-control" name="product_name">
                        {{-- Error Message--}}
                        @error('product_name') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Product Regular Price</h4></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" name="product_regular_price">
                                </div>
                                {{-- Error Message--}}
                                @error('product_regular_price') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Product Discounted Price</h4></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" name="product_discounted_price">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group input-primary">
                                <label><h4>Product Weight (Optional)</h4></label>
                                <input type="text" class="form-control" name="product_weight">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group input-primary">
                                <label><h4>Product Dimensions (Optional)</h4></label>
                                <input type="text" class="form-control" name="product_dimensions">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group input-primary">
                                <label><h4>Product Materials (Optional)</h4></label>
                                <input type="text" class="form-control" name="product_materials">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Product Other Info (Optional)</h4></label>
                                <input type="text" class="form-control" name="product_other_info">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Product Short Description</h4></label>
                                <input type="text" class="form-control" name="product_short_description">
                                {{-- Error Message--}}
                                @error('product_short_description') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Choose Category</h4></label>
                                <select name="product_category_id" class="form-control" id="category_select">
                                    <option value="">- Select a Category -</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                {{-- Error Message--}}
                                @error('product_category_id') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group input-primary">
                                <label><h4>Choose Subcategory</h4></label>
                                <select name="product_subcategory_id" class="form-control" id="subcategory_select">
                                    <option value="">- Select a Subcategory -</option>
                                </select>
                                {{-- Error Message--}}
                                @error('product_subcategory_id') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Product Long Description (Optional)</h4></label>
                        <textarea id="product_long_description" name="product_long_description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Product Thumbnail Photo</h4></label>
                        <input type="file" class="form-control" name="product_thumbnail_photo">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_scripts')
<script>
    $(document).ready(function() {
        $('#category_select').select2();
        $('#subcategory_select').select2();
        $('#product_long_description').summernote();
        $('#category_select').change(function(){
            var category_id = $(this).val();

            // Ajax Start //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/get/subcategory',
                data: {category_id: category_id},
                success: function(data){
                    $('#subcategory_select').html(data);
                }
            });
            // Ajax End //
        })
    });
</script>
@endsection

