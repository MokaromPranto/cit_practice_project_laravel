@extends('dashboard.dashboard-master')


@section('page_title')
Inventory Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.inventory', $product->id) }}">Inventory</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.inventory', $product->id) }}">Inventory Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Inventory</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('product.inventory.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Choose Color</h4></label>
                        @foreach ($colors as $color)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="color_id" value="{{ $color->id }}">
                                <h4>{{ $color->color_name }}&nbsp;&nbsp;<span style="background-color: {{ $color->color_code }}" class="px-2 rounded-circle">&nbsp;&nbsp;</span></h4>
                            </label>
                        </div>
                        @endforeach
                        {{-- Error Message--}}
                        @error('color_id') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Select Size</h4></label>
                        <select name="size_id" class="form-control">
                            <option value="">-Select a Size-</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                        {{-- Error Message--}}
                        @error('size_id') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Quantity</h4></label>
                        <input class="form-control" type="number" name="quantity">
                        {{-- Error Message--}}
                        @error('quantity') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Product Name : {{ $product->product_name }} </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Color</h4></th>
                            <th><h4>Size</h4></th>
                            <th><h4>Qauntity</h4></th>
                            <th><h4>Market Value($)</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                            <tr>
                                <td>
                                    {{ $inventory->relationwithcolor->color_name }}&nbsp;&nbsp;<span style="background-color: {{ $inventory->relationwithcolor->color_code }}" class="px-2 rounded-circle">&nbsp;</span>
                                </td>
                                <td>{{ $inventory->relationwithsize->size_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    ${{ $product->product_regular_price *  $inventory->quantity}}
                                </td>
                            </tr>
                            @endforeach
                            <td colspan="2" class="text-center">
                                <b>Total</b>
                            </td>
                            <td><b>{{ $inventories->sum('quantity') }}</b></td>
                            <td><b>${{ $inventories->sum('quantity') * $product->product_regular_price }}</b></td>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

