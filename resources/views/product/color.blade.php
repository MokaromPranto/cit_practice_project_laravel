@extends('dashboard.dashboard-master')


@section('page_title')
Colors Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.color') }}">Colors</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.color') }}">Colors Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Colors</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('product.color.store') }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Color Name</h4></label>
                        <input type="text" class="form-control form-control-lg" name="color_name">
                        {{-- Error Message--}}
                        @error('color_name') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Pick a Color :</h4></label>
                        <input type="color" name="color_code">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>View Colors</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Color Name</h4></th>
                            <th><h4>Color View</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->color_name }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $color->color_code }}">&nbsp;</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

