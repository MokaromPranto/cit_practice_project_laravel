@extends('dashboard.dashboard-master')


@section('page_title')
Sizes Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.size') }}">Sizes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.size') }}">Sizes Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Sizes</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('product.size.store') }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Sizes</h4></label>
                        <input type="text" class="form-control form-control-lg" name="size_name" placeholder="( 'XXL' , 'XL' , 'L' , 'M' , 'S' , 'XS' )">
                        {{-- Error Message--}}
                        @error('size_name') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>View Sizes</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Size Name</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $size->size_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

