
@extends('dashboard.dashboard-master')


@section('page_title')
Subcategory Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('subcategory.create') }}">Subcategory</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('subcategory.create') }}">Subcategory Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Subcategory</h3><span class="badge badge-secondary"><|> Without Page Load <|></span>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group input-primary">
                    <label><h4>Choose Category</h4></label>
                    <select name="category_id" class="form-control form-control-lg" id="category_id">
                        <option value="">-Select a Category-</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group input-primary">
                    <label><h4>Subcategory Name</h4></label>
                    <input id="subcategory_name" type="text" class="form-control form-control-lg" name="subcategory_name">
                </div>
                <div class="form-group">
                    <button id="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                    </span>Add</button>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_scripts')
<script>
    $('#submit').click(function(){
        var subcategory_name = $('#subcategory_name').val();
        var category_id = $('#category_id').find(":selected").val();

        // Ajax Start //
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('subcategory.store') }}",
            data: {category_id:category_id, subcategory_name: subcategory_name},
            success: function(data){
                Swal.fire(
                '',
                'Subcategory Added Successfully!',
                'success'
                )
                $('#category_id').val("");
                $('#subcategory_name').val("");
            }
        });
        // Ajax End //
    });

</script>
@endsection




