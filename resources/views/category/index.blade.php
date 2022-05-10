@extends('dashboard.dashboard-master')

@section('page_title')
Category List
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('category.create') }}">Category</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Category List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List of Categories</h3>
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
            @if (session('cat_restore_success'))
                <div class="alert alert-success">
                    {{ session('cat_restore_success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Category Name</h4></th>
                            <th><h4>Category Photo</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $categories as $category )
                            <tr>
                                <td>{{$category->category_name}}</td>
                                <td class="w-50">
                                    <img class="w-25" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="not found">
                                </td>
                                <td>
                                    <a href="{{ route('category.show',$category) }}" class="btn btn-info btn-sm">Details</a>
                                    <a href="{{ route('category.edit',$category) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('category.destroy',$category) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Soft Delete</button>
                                    </form>
                                    {{-- <form action="{{ route('category.harddelete',$category->id) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hard Delete</button>
                                    </form> --}}
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List of <spanc class="text-danger">Deleted</spanc> Categories</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Category Name</h4></th>
                            <th><h4>Category Photo</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $deleted_categories as $category )
                            <tr>
                                <td>{{$category->category_name}}</td>
                                <td class="w-50">
                                    <img class="w-25" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="not found">
                                </td>
                                <td>
                                    <a href="{{ route('category.restore', $category->id) }}" class="btn btn-success btn-sm">Restore Category</a>
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

