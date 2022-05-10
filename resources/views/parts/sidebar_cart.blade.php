

    <!-- OffCanvas Cart Start -->
    <div class="offcanvas-overlay"></div>
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">My Cart Items</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
                    @forelse ( $carts as $cart)
                    <li>
                        <a href="single-product.html" class="image"><img src="{{ asset('uploads/product_thumbnail') }}/{{ $cart->relationwithproduct->product_thumbnail_photo }}"
                                alt="Cart product Image"></a>
                        <div class="content">
                            <a href="single-product.html" class="title">{{ $cart->relationwithproduct->product_name }}</a>
                            <span class="quantity-price">{{ $cart->user_stock_ammount }} x <span class="amount">
                                @if ($cart->relationwithproduct->product_discounted_price)
                                    {{ $cart->relationwithproduct->product_discounted_price}}
                                @else
                                    {{$cart->relationwithproduct->product_regular_price}}
                                @endif
                            </span></span>
                            <a href="{{ route('remove.cart', $cart->id) }}" class="remove">×</a>
                        </div>
                    </li>
                    @empty
                    <li><h4 class="text-danger">No Item Added to Cart</h4></li>
                    @endforelse
                </ul>
            </div>
            <div class="foot">
                <div class="buttons mt-30px">
                    @if (total_cart_item() > 0)
                        <a href="{{ route('cart') }}" class="btn btn-dark btn-hover-primary mb-30px">View cart</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->
