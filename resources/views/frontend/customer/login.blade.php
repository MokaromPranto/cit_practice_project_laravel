@extends('layouts.app_frontend')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Customer</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="tab-content">
                        <div class="login-form-container">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h3 class="text-danger fw-bold text-center mb-4">Login</h3>
                            <div class="login-register-form">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"/>
                                    {{-- Error Message--}}
                                    @error('email') <p class="ps-1 text-danger">{{ $message }}</p> @enderror
                                    <input type="password" name="password" placeholder="Password" />
                                    <div class="button-box text-center mb-3">
                                        <button type="submit"><span>Login</span></button>
                                    </div>
                                </form>
                                <h5 class="mb-4 text-center">Don't have an Account? <a class="text-danger fw-bold h4" href="{{ route('customer') }}">Register</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
