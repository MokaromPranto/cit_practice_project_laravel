@extends('layouts.app_frontend')

@section('content')

    <!-- Sidebar Cart Start -->
    @include('parts.sidebar_cart')
    <!-- Sidebar Cart End -->
    <!-- Hero/Intro Slider Start -->
    <div class="section ">
        <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
            <!-- Hero slider Active -->
            <div class="swiper-wrapper">
                <!-- Single slider item -->
                @foreach ($banners as $banner)
                    <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                        <div class="container align-self-center">
                            <div class="row">
                                <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                                    <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                        <span class="category">{{ $banner->banner_text }}</span>
                                        <h2 class="title-1">{{ $banner->banner_title }}</h2>
                                        <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                            Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div
                                    class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                                    <div class="show-case">
                                        <div class="hero-slide-image">
                                            <img src="{{ asset('uploads/banner') }}/{{ $banner->banner_photo }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-white"></div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- Hero/Intro Slider End -->

    <!-- Feature Area Srart -->
    <div class="feature-area  mt-n-65px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- single item -->
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/images') }}/icons/1.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Free Shipping</h4>
                            <span class="sub-title">Capped at $39 per order</span>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/images') }}/icons/2.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Card Payments</h4>
                            <span class="sub-title">12 Months Installments</span>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/images') }}/icons/3.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Easy Returns</h4>
                            <span class="sub-title">Shop With Confidence</span>
                        </div>
                    </div>
                    <!-- single item -->
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area End -->

    <!-- Product Area Start -->
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-12">
                    <div class="section-title text-center mb-0">
                        <h2 class="title">#products_by_category</h2>
                        <!-- Tab Start -->
                        <div class="nav-center">
                            <ul class="product-tab-nav nav align-items-center justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-product--all">All</a>
                                </li>
                                @foreach ($categories as $category )
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tab-product--{{ $category->id }}">{{ $category->category_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Tab End -->
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- Section Title & Tab End -->

            <div class="row">
                <div class="col">
                    <div class="tab-content mb-30px0px">
                        <!-- All tab start -->
                        <div class="tab-pane fade show active" id="tab-product--all">
                            <div class="row">
                                @foreach ($products as $product)
                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                    @include('parts.product_thumb')
                                </div>
                                @endforeach
                                @if ($total_products > 4 )
                                    <a href="{{route('shop')}}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> See All <i class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
                                @endif
                            </div>
                        </div>
                        <!-- All tab end -->
                        <!-- Categorywise tab start -->
                        @forelse ( $categories as $category )
                        <div class="tab-pane fade" id="tab-product--{{ $category->id }}">
                            <div class="row">
                                @forelse (App\Models\Product::where('product_category_id', $category->id)->get() as $product)
                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                    @include('parts.product_thumb')
                                </div>
                                @empty
                                <div class="alert alert-danger">
                                    No Product to Show in this Category!
                                </div>
                                @endforelse
                            </div>
                        </div>
                        @endforeach
                        <!-- Categorywise tab end -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Product Area End -->

    <!-- Banner Area Start -->
    <div class="banner-area pt-100px pb-100px plr-15px">
        <div class="row m-0">
            @foreach ($categories as $category)
                <div class="d-none col-12 col-lg-4 center-col mb-md-30px mb-lm-30px mb-3 category_div">
                    <div class="single-banner-2">
                        <img width="600" height="330" src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="not found">
                        <div class="item-disc">
                            <h4 class="title">Best Collection <br>
                                For {{ $category->category_name }}</h4>
                            <a href="{{ route('shop') }}" class="shop-link btn btn-primary">Shop Now <i class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a id="loadmore" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
    </div>
    <!-- Banner Area End -->

    <!-- Product Area Start -->
    <div class="product-area pt-100px pb-100px">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg col-md col-12">
                    <div class="section-title mb-0">
                        <h2 class="title">#filter_products</h2>
                    </div>
                </div>
                <!-- Section Title End -->

                <!-- Tab Start -->
                <div class="col-lg-auto col-md-auto col-12">
                    <ul class="product-tab-nav nav">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-product-all">All</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-on-sale">On Sale</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-not-on-sale">Not On Sale</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-itemssale">Items Sale</a></li> --}}
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title & Tab End -->

            <div class="row">
                <div class="col">
                    <div class="tab-content top-borber">
                        <!-- 1st tab start -->
                        <div class="tab-pane fade show active" id="tab-product-all">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($all_products as $product)
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Product -->
                                        @include('parts.product_thumb')
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 1st tab end -->
                        <!-- 2nd tab start -->
                        <div class="tab-pane fade" id="tab-product-on-sale">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($on_sale_products as $product)
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Product -->
                                        @include('parts.product_thumb')
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 2nd tab end -->
                        <!-- 3rd tab start -->
                        <div class="tab-pane fade" id="tab-product-not-on-sale">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    @foreach ($not_on_sale_products as $product)
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Product -->
                                        @include('parts.product_thumb')
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 3rd tab end -->
                        <!-- 4th tab start -->
                        {{-- <div class="tab-pane fade" id="tab-product-itemssale">
                            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                <div class="new-product-wrapper swiper-wrapper">
                                    <div class="new-product-item swiper-slide">
                                        <!-- Single Product -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="{{ route('shop') }}" class="image">
                                                    <img src="{{ asset('frontend/images') }}/product-image/8.jpg" alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                        title="Quick view" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <button title="Add To Cart" class=" add-to-cart">Add
                                                    To Cart</button>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="{{ route('shop') }}">Women's Elizabeth
                                                        Coat
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">$38.50</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-buttons">
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- 4th tab end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End -->

    <!--  Blog area Start -->
    <div class="main-blog-area pb-100px pt-100px">
        <div class="container">
            <!-- section title start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center mb-30px0px">
                        <h2 class="title">#blogs</h2>
                        </p>
                    </div>
                </div>
            </div>
            <!-- section title start -->

            <div class="row">
                @forelse ($posts as $post)
                    @include('parts.single_blog')
                @empty
                <div class="text-danger text-center">
                    <b>No Blogs Available</b>
                </div>
                @endforelse
                <a href="{{route('blog')}}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> See All <i class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>

            </div>
        </div>
    </div>
    <!--  Blog area End -->

@endsection
