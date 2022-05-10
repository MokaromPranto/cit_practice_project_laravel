
@extends('layouts.app_frontend')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Checkout</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->


<!-- checkout area start -->
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    {{-- Form Start --}}
                    <form action="{{ route('checkout.post') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Name</label>
                                <input type="text" value="{{ auth()->user()->name }}" name="customer_name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" name="customer_email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Phone</label>
                                <input type="text" value="{{ auth()->user()->phone_number }}" name="customer_phone_number">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Country</label>
                                <input type="text" value="{{ App\Models\Country::find(session('s_country_id'))->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>City</label>
                                <input type="text" value="{{ session('s_city_name') }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Address</label>
                                <input class="billing-address" placeholder="House number and street name" type="text"  name="customer_address">
                            </div>
                        </div>
                    </div>
                    <div class="additional-info-wrap">
                        <h4>Additional Information</h4>
                        <div class="additional-info">
                            <textarea name="customer_notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total mb-3"><h5><b>Total Amount</b></h5></li>
                                    <li><h5><b>{{ session('s_total_ammount') }}</b></h5></li>
                                </ul>
                                <ul>
                                    <li class="order-total mb-3">Coupon Discount</li>
                                    <li>{{ session('s_discount_amount') }}</li>
                                </ul>
                                <ul>
                                    <li class="order-total mb-3">Shipping Charge</li>
                                    <li>{{ session('s_shipping_charge') }}</li>
                                </ul>
                                <ul>
                                    <li class="order-total mb-3"><h5><b>Grand Total</b></h5></li>
                                    <li><h5><b>{{ session('s_grand_total') }}</b></h5></li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion element-mrg">
                                <h5><b>Payment Method</b></h5>
                                <select name="payment_method" class="form-control">
                                    {{-- <option value="">-Select an Option-</option> --}}
                                    <option value="cod">Cash On Delivery (COD)</option>
                                    <option value="online">Online Payment (Card/bKash)</option>
                                </select>
                            </div>
                        </div>

                        <div class="discount-code-wrapper p-0 mt-5 text-center">
                            <div class="discount-code">
                                <button class="cart-btn-2" type="submit" class="btn-hover">Place Order</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->
@endsection
