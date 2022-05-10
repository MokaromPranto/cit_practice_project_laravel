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
                <h2 class="breadcrumb-title">Blog</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
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
            {{-- Start Single Blog --}}
            {{-- End Single Blog --}}
            @forelse ($posts as $post)
            @include('parts.single_blog')
            @empty
                No Blogs to Show
            @endforelse
        </div>

        <!--  Pagination Area Start -->
            <div class="pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="pages">
                <ul>
                    <li class="li"><a class="page-link" href=""><i class="fa fa-angle-left"></i></a></li>
                    <li class="li"><a class="page-link active" href="">1</a></li>
                    <li class="li"><a class="page-link" href="">2</a></li>
                    <li class="li"><a class="page-link" href=""><i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <!--  Pagination Area End -->
    </div>
</div>
<!-- Blag Area End -->

@endsection




