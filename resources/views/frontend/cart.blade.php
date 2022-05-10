
@extends('layouts.app_frontend')

@section('content')


    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Cart</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">
                        <b>{{ session('success') }}</b>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        <b>{{ session('error') }}</b>
                    </div>
                @endif
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('update.cart') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_ammount = 0;
                                        $go_next = true;
                                    @endphp

                                    @forelse ( $carts as $cart )
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px" src="{{ asset('uploads/product_thumbnail') }}/{{ $cart->relationwithproduct->product_thumbnail_photo }}" alt="Product Image" /></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">{{ $cart->relationwithproduct->product_name }}</a>
                                            <p>
                                                Color: <span class="badge rounded-circle" style="background-color: {{ $cart->relationwithcolor->color_code }}">&nbsp;</span>
                                            </p>
                                            <p>
                                                Size: {{ $cart->relationwithsize->size_name }}
                                            </p>
                                        </td>
                                        <td class="product-price-cart">
                                            <span class="amount">
                                                @if ($cart->relationwithproduct->product_discounted_price)
                                                    {{$unit_price = $cart->relationwithproduct->product_discounted_price}}
                                                @else
                                                    {{$unit_price = $cart->relationwithproduct->product_regular_price}}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="cart_item[{{$cart->id}}]" value="{{ $cart->user_stock_ammount }}">

                                                @if ( available_stock($cart->product_id, $cart->color_id, $cart->size_id) < $cart->user_stock_ammount )
                                                    <span class="badge bg-danger">Out of Stock</span>
                                                    <span class="badge bg-success">Available: {{ available_stock($cart->product_id, $cart->color_id, $cart->size_id) }}</span>
                                                    @php
                                                         $go_next = false;
                                                    @endphp
                                                @endif

                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            {{$unit_price * $cart->user_stock_ammount}}
                                            @php
                                                $total_ammount += $unit_price * $cart->user_stock_ammount;
                                            @endphp
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{ route('remove.cart', $cart->id) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">
                                            No Item Added To Cart
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('shop') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        <a href="{{ route('clear.cart') }}">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid" id="country_select">
                                                <option value="">-Select Country-</option>
                                                @foreach ($shippings as $shipping)
                                                <option value="{{ $shipping->country_id }}">{{ $shipping->relationwithcountry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * City
                                            </label>
                                            <select class="email s-email s-wid" id="city_select">
                                                <option>-Choose Country First-</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <small class="badge bg-danger mb-1" id="coupon_error"></small>
                                    <input type="text" id="coupon_name" />
                                    <button class="cart-btn-2" id="apply_coupon">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total Ammounts <span id="total_ammount">{{$total_ammount}}</span></h5>
                                <h5>(-) Coupon Discounts <span id="discount_amount">0</span></h5>
                                <h5>(+ ) Shipping Charges <span id="shipping_charge">0</span></h5>
                                <h4 class="grand-totall-title">Grand Total <span id="grand_total">{{$total_ammount}}</span></h4>
                                @if ($go_next)
                                    <a class="d-none" style="cursor: pointer" id="checkout_btn">Proceed to Checkout</a>
                                @else
                                    <div class="alert alert-danger text-center">Please Check Product Stock!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Car -->
@endsection
@section('footer_scripts')
<script>
    $(document).ready(function(){
        $('#country_select').change(function(){
            var country_id = $(this).val();
            // Ajax Start //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/get/city',
                data: {country_id: country_id},
                success: function(data){
                    $('#city_select').html(data);
                }
            });
            // Ajax End //
            $('#checkout_btn').addClass('d-none');
            $('#shipping_charge').html(0);
            var grand_total = parseInt($('#total_ammount').html()) - parseInt($('#discount_amount').html()) + parseInt($('#shipping_charge').html());
            $('#grand_total').html(grand_total);
        });
        $('#city_select').change(function(){
            $('#shipping_charge').html($(this).val());
            var total_ammount = $('#total_ammount').html();
            var shipping_charge = $('#shipping_charge').html();
            $('#grand_total').html(parseInt(total_ammount) + parseInt(shipping_charge));
            $('#checkout_btn').removeClass('d-none');
            var grand_total = parseInt($('#total_ammount').html()) - parseInt($('#discount_amount').html()) + parseInt($('#shipping_charge').html());
            $('#grand_total').html(grand_total);
        });
        $('#apply_coupon').click(function(){
            var coupon_name = $('#coupon_name').val();
            var total_ammount = parseInt($('#total_ammount').html());
            // Ajax Start //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/check/coupon',
                data: {coupon_name: coupon_name, total_ammount: total_ammount},
                success: function(data){
                    if(data.error){
                        $('#coupon_error').html(data.error);
                        $('#coupon_name').val("");
                    }else{
                        $('#discount_amount').html(data.good);
                        var grand_total = parseInt($('#total_ammount').html()) - parseInt($('#discount_amount').html()) + parseInt($('#shipping_charge').html());
                        $('#grand_total').html(grand_total);
                        $('#coupon_error').html("");
                    }
                },
            });
            // Ajax End //
            if(!coupon_name){
                $('#discount_amount').html(0);
                var grand_total = parseInt($('#total_ammount').html()) - parseInt($('#discount_amount').html()) + parseInt($('#shipping_charge').html());
                $('#grand_total').html(grand_total);
            }
        });

        $('#checkout_btn').click(function(){
            var total_ammount = parseInt($('#total_ammount').html());
            var discount_amount = parseInt($('#discount_amount').html());
            var shipping_charge = parseInt($('#shipping_charge').html());
            var grand_total = parseInt($('#grand_total').html());
            var country_id = $('#country_select').val();
            var city_name = $('#city_select').find(":selected").text();
            var coupon_name = $('#coupon_name').val();
             // Ajax Start //
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/checkout/redirect',
                data: {total_ammount: total_ammount, discount_amount:discount_amount, shipping_charge:shipping_charge, grand_total:grand_total, coupon_name:coupon_name, city_name:city_name, country_id:country_id},
                success: function(data){
                    window.location.href = 'checkout';
                },
            });
            // Ajax End //
        })
    });
</script>
@endsection
