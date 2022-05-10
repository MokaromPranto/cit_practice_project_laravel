@extends('layouts.app_frontend')

@section('content')


<!-- Sidebar Cart Start -->
@include('parts.sidebar_cart')
<!-- Sidebar Cart End -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{asset('uploads/product_thumbnail')}}/{{ $product_detail->product_thumbnail_photo }}" alt="not Found">
                        </div>
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{asset('frontend')}}/images/product-image/zoom-image/2.jpg"
                                alt="">
                        </div>
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{asset('frontend')}}/images/product-image/zoom-image/3.jpg"
                                alt="">
                        </div>
                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{asset('frontend')}}/images/product-image/zoom-image/4.jpg"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        @foreach ($product_gallery_photos as $product_gallery_photo)
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto" src="{{asset('uploads/product_gallery_photo')}}/{{ $product_gallery_photo->product_gallery_photo_name }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <h2>{{ $product_detail->product_name }}</h2>
                    <h5>Stock: <span id="stock_ammount">-</span></h5>
                    <div class="pricing-meta">
                        <ul>
                            @if ($product_detail->product_discounted_price)
                                <span style="text-decoration: line-through" class="new">${{ $product_detail->product_regular_price }}</span>
                                <span class="badge bg-danger text-white new">${{ $product_detail->product_discounted_price }}</span>
                            @else
                                <span  class="new">${{ $product_detail->product_regular_price }}</span>
                            @endif
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                    </div>
                    <input type="hidden" class="form-control" name="choosed_color_id" id="choosed_color_id">
                    <input type="hidden" class="form-control" name="choosed_size_id" id="choosed_size_id">
                    <div class="pro-details-color-info d-flex align-items-center">
                        <span>Color</span>
                        <div class="pro-details-color">
                            <ul>
                                @forelse ($colors as $color)
                                    @if ($color->relationwithcolor->color_name == 'N/A')
                                        <li>
                                            <span id="{{ $color->color_id }}" class="color_option bg-secondary text-white badge mt-2">No Color</span>
                                        </li>
                                    @else
                                        <li><a class="color_option" id="{{ $color->color_id }}" style="background-color: {{ $color->relationwithcolor->color_code }}" ></a></li>
                                    @endif
                                @empty
                                No Colors Available for this Product :(
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <div class="pro-details-size-info d-flex align-items-center">
                        <span>Size</span>
                        <div class="pro-details-size">
                            <select class="form-control" id="size_dropdown">
                                <option value="">-Please Choose a Color-</option>
                            </select>
                        </div>
                    </div>
                    <p class="m-0">{{$product_detail->product_short_description}}</p>
                    <div class="pro-details-quality">
                        <div class="cart-plus-minus">
                            <input id="user_stock_ammount" class="cart-plus-minus-box" type="number" name="qtybutton" value="1" />
                        </div>
                        <div class="pro-details-cart">
                            <input id="auth_check" type="hidden" value=@auth "true" @else "false" @endauth>
                            <button id="add_to_cart_btn" class="add-cart"> Add To Cart</button>
                        </div>
                        <div class="pro-details-compare-wishlist pro-details-wishlist ">
                            <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div>
                        <div class="pro-details-compare-wishlist pro-details-compare">
                            <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                        </div>
                    </div>
                    <div class="pro-details-sku-info pro-details-same-style  d-flex">
                        <span>SKU: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{$product_detail->product_sku}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex">
                        <span>Category: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{$product_detail->relationwithcategory->category_name}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-categories-info pro-details-same-style d-flex">
                        <span>Subcategory: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="#">{{$product_detail->relationwithsubcategory->subcategory_name}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-social-info pro-details-same-style d-flex">
                        <span>Share: </span>
                        <ul class="d-flex">
                            <li><a href="http://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}&t={{$product_detail->product_name}}" target="_blank" class="share-popup"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="http://www.twitter.com/intent/tweet?url={{ url()->full() }}&text={{$product_detail->product_name}}" target="_blank" class="share-popup"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details2">Information</a>
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li>
                                <a href="#">{{$product_detail->relationwithsubcategory->subcategory_name}}</a>
                            </li>

                            <li><span>Weight</span> {{$product_detail->product_weight}}</li>
                            <li><span>Dimensions</span> {{$product_detail->product_dimensions}}</li>
                            <li><span>Materials</span> {{$product_detail->product_materials}}</li>
                            <li><span>Other Info</span> {{$product_detail->product_other_info}}</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>
                            {!! $product_detail->product_long_description !!}
                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{asset('frontend')}}/images/review-image/1.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="{{asset('frontend')}}/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    <button class="btn btn-primary btn-hover-color-primary "
                                                        type="submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
            <div class="new-product-wrapper swiper-wrapper">
                @forelse ($related_product as $product )
                <div class="new-product-item swiper-slide">
                    <!-- Single Prodect -->
                    @include('parts.product_thumb')
                </div>
                @empty
                    <div class="alert alert-danger text-center">
                        No Related Products Available!
                    </div>
                @endforelse
            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- Related product Area End -->
@endsection

@section('footer_scripts')
<script>
    $(document).ready(function(){
        $('.color_option').click(function(){
            var product_id = "{{ $product_detail->id }}";
            var color_id = $(this).attr('id');
            $('#choosed_color_id').val(color_id);
            // Ajax Start //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/get/size',
                data: {product_id: product_id, color_id:color_id},
                success: function(data){
                    $('#size_dropdown').html(data);
                }
            });
            // Ajax End //
        });
        $('#size_dropdown').change(function(){
            $('#choosed_size_id').val($(this).val());

            var product_id = "{{ $product_detail->id }}";
            var color_id = $('#choosed_color_id').val();
            var size_id = $('#choosed_size_id').val();
            // // Ajax Start //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/get/stock',
                data: {product_id: product_id, color_id: color_id, size_id: size_id},
                success: function(data){
                    $('#stock_ammount').html(data);                }
            });
            // Ajax End //
        });
        $('#add_to_cart_btn').click(function(){
            // alert($('#auth_check').val());
            if($('#auth_check').val() == "false"){
                Swal.fire({
                    title: 'You are not Logged In',
                    text: "Please Login First!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Login Now!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='{{ route('customer') }}'
                    }
                })
            }else{
                if($('#choosed_color_id').val()){
                    if($('#choosed_size_id').val()){
                        var stock_ammount = $('#stock_ammount').html();
                        var user_stock_ammount = $('#user_stock_ammount').val();

                        if(parseInt(user_stock_ammount) > parseInt(stock_ammount)){
                            Swal.fire(
                            'Stock Not Available',
                            '',
                            'error',
                            )
                        }
                        else{
                            var product_id = "{{ $product_detail->id }}";
                            var color_id = $('#choosed_color_id').val();
                            var size_id = $('#choosed_size_id').val();
                            var user_stock_ammount = $('#user_stock_ammount').val()
                            var user_id = "{{ auth()->id() }}"
                            // Ajax Start //
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'POST',
                                url: '/add/to/cart',
                                data: {product_id: product_id, color_id:color_id, size_id:size_id, user_stock_ammount:user_stock_ammount, user_id:user_id},
                                success: function(data){
                                    Swal.fire(
                                    'Added to Cart Successfully!',
                                    '',
                                    'success',
                                    )
                                }
                            });
                            // Ajax End //
                        }
                    }
                    else{
                        Swal.fire(
                        'Choose A Size',
                        '',
                        'info',
                        )
                    }
                }
                else{
                    Swal.fire(
                    'Choose A Color',
                    '',
                    'info',
                    )
                }
            }
        });
    });
</script>
@endsection
