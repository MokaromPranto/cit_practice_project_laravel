@extends('dashboard.dashboard-master')


@section('page_title')
Coupons Add
@endsection()

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Add Coupons</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Coupon Name</h4></label>
                        <small class="text-secondary">(Must be Unique)</small>
                        <input type="text" class="form-control form-control-lg" name="coupon_name">
                        {{-- Error Message--}}
                        @error('coupon_name') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Choose Coupon Type</h4></label>
                        <select name="coupon_type" class="form-control" id="">
                            <option value="">- Select Coupon Type -</option>
                            <option value="1">Percentage (%)</option>
                            <option value="2">Flat Discount</option>
                        </select>
                        {{-- Error Message--}}
                        @error('coupon_type') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Coupon Amount</h4></label>
                        <input type="number" class="form-control form-control-lg" name="coupon_amount">
                        {{-- Error Message--}}
                        @error('coupon_amount') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Coupon Limit</h4></label>
                        <input type="number" class="form-control form-control-lg" name="coupon_limit">
                        {{-- Error Message--}}
                        @error('coupon_limit') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Coupon Validity</h4></label>
                        <input type="date" class="form-control form-control-lg" name="coupon_validity" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        {{-- Error Message--}}
                        @error('coupon_validity') <span class="badge badge-danger mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3>Available Coupons</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th><h4>Name</h4></th>
                            <th><h4>Discount</h4></th>
                            <th><h4>Limit</h4></th>
                            <th><h4>Validity</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->coupon_name }}</td>
                            <td>{{ $coupon->coupon_amount }}{{ ($coupon->coupon_type == 1) ? '%' : '$' }}</td>
                            <td>{{ $coupon->coupon_limit }}</td>
                            <td>{{ $coupon->coupon_validity}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">No Valid Coupon Available!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


