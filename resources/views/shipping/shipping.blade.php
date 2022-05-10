@extends('dashboard.dashboard-master')


@section('page_title')
Shipping Add
@endsection()

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Shipping Charge</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('add.shipping') }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Choose a Country</h4></label>
                        <select name="country_id" class="form-control" id="country_select">
                            <option value="">- Select a Country -</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        {{-- Error Message--}}
                        @error('country_id') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>City Name</h4></label>
                        <input type="text" class="form-control form-control-lg" name="city_name">
                        {{-- Error Message--}}
                        @error('city_name') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Delivery Days</h4></label>
                        <input type="number" class="form-control form-control-lg" name="delivery_days">
                        {{-- Error Message--}}
                        @error('delivery_days') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Shipping Charge</h4></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" name="shipping_charge">
                        </div>
                        {{-- Error Message--}}
                        @error('shipping_charge') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Shipping Charge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Shipping Chart</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><h4>Country</h4></th>
                            <th><h4>City</h4></th>
                            <th><h4>Delivery Days</h4></th>
                            <th><h4>Charge</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shippings as $shipping)
                        <tr>
                            <td>{{ $shipping->relationwithcountry->name }}</td>
                            <td>{{ $shipping->city_name }}</td>
                            <td>{{ $shipping->delivery_days }}</td>
                            <td>{{ $shipping->shipping_charge }}</td>
                        </tr>
                            @empty
                            <tr class="text-danger text-center"><td colspan="50">No Shipping Charge Added Yet!</td></tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
<script>
    $(document).ready(function(){
        $('#country_select').select2();
    });
</script>
@endsection

