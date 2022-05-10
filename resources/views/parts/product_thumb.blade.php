
<!-- Single Product -->
<div class="product">
    <div class="thumb">
        <a href="{{ route('product.details', $product->slug) }}" class="image">
            <img src="{{ asset('uploads/product_thumbnail') }}/{{$product->product_thumbnail_photo}}" alt="Not Found" />
        </a>
        <span class="badges">
            @if ($product->product_discounted_price)
            <span class="sale">{{ 100 - round($product->product_discounted_price/$product->product_regular_price*100) }}% off</span>
            @endif

            @if ($product->created_at->diffInDays(\Carbon\Carbon::now()) <= 1)
                <span class="new">New</span>
            @endif
            </span>
            <div class="actions">
                <a href="{{ route('product.details', $product->slug) }}" class="action wishlist" title="Wishlist"><i
                        class="pe-7s-like"></i></a>
                <a href="#" class="action quickview" data-link-action="quickview"
                    title="Quick view" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                <a href="compare.html" class="action compare" title="Compare"><i
                        class="pe-7s-refresh-2"></i></a>
            </div>
            <a href="{{ route('product.details', $product->slug) }}" title="Add To Cart" class=" add-to-cart">Details</a>
        </div>
        <div class="content">
            <span class="ratings">
                <span class="rating-wrap">
                    <span class="star" style="width: 100%"></span>
                </span>
                <span class="rating-num">( 5 Review )</span>
            </span>
            <h5 class="title">
                <a href="single-product.html">
                    {{ $product->product_name }}
                </a>
            </h5>
            <span class="price">
                @if ($product->product_discounted_price)
                    <span style="text-decoration: line-through" class="new">${{ $product->product_regular_price }}</span>
                    <span class="badge bg-danger text-white new">${{ $product->product_discounted_price }}</span>
                @else
                    <span  class="new">${{ $product->product_regular_price }}</span>
                @endif
            </span>
        </div>
    </div>

