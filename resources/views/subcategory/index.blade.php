@extends('dashboard.dashboard-master')

@section('page_title')
Subcategory List
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('subcategory.create') }}">Subcategory</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('subcategory.index') }}">Subcategory List</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List of Subcategories</h3>
            </div>
            @if (session('update_msg'))
                <div class="alert alert-primary">
                    {{ session('update_msg') }}
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
                            <th><h4>Subcategory Under Category</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $category_ingroup as $category)
                            <tr class="text-center">
                                <td colspan="5">
                                    <b>{{ App\Models\Category::find($category->category_id)->category_name }}</b>
                                </td>
                            </tr>
                            @foreach (App\Models\Subcategory::where('category_id', $category->category_id)->get() as $subcategory)
                            <tr>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>Buttons</td>
                            </tr>
                            @endforeach

                            {{-- Empty --}}
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

