@extends('layouts.app_frontend')

@section('content')


<!-- Sidebar Cart Start -->
@include('parts.sidebar_cart')
<!-- Sidebar Cart End -->


<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Blog Details</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blog Details</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Blog Area Start -->
<div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="blog-posts">
                    <div class="single-blog-post blog-grid-post">
                        <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                            <img class="img-fluid h-auto" src="{{ asset('uploads/post_img') }}/{{ $blog_detail->post_image }}" alt="blog" />
                        </div>
                        <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href=""><i class="fa fa-calendar" aria-hidden="true"></i> {{ $blog_detail->created_at->format('d-M-y')}}</a>
                            </div>
                            <h4 class="blog-title">{{ $blog_detail->post_title }}</h4>
                            <p data-aos="fade-up">
                                {!! $blog_detail->post_des !!}
                            </p>
                        </div>
                    </div>
                    <!-- single blog post -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blag Area End -->
@endsection

