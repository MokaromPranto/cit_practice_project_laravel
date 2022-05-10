
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
                    <li class="breadcrumb-item active">Register</li>
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
                            <h3 class="text-danger fw-bold text-center mb-4">Register</h3>
                            <div class="login-register-form">
                                <form action="{{ route('customer.register') }}" method="POST">
                                    @csrf
                                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"/>
                                    {{-- Error Message--}}
                                    @error('name') <p class="ps-1 text-danger">{{ $message }}</p> @enderror

                                    <input type="email" name="email" placeholder="Email" {{ old('email') }} />
                                    {{-- Error Message--}}
                                    @error('email') <p class="ps-1 text-danger">{{ $message }}</p> @enderror

                                    <input type="password" name="password" placeholder="Password" />
                                    {{-- Error Message--}}
                                    @error('password') <p class="ps-1 text-danger">{{ $message }}</p> @enderror

                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                                    {{-- Error Message--}}
                                    @error('password_confirmation') <p class="ps-1 text-danger">{{ $message }}</p> @enderror

                                    {{-- Captcha Code Start--}}
                                    <div class="form-group mt-2 mb-2">
                                        <div class="captcha">
                                            <span>{!! captcha_img() !!}</span>
                                            <button type="button" class="btn btn-danger p-1" class="reload" id="reload">
                                                &#x21bb;
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                        {{-- Error Message--}}
                                        @error('captcha') <p class="ps-1 text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    {{-- Captcha Code End --}}

                                    <div class="button-box text-center mb-4">
                                        <button type="submit"><span>Register</span></button>
                                    </div>
                                </form>
                            </div>
                            <h5 class="mb-4 text-center">Already have an Account? <a class="text-danger fw-bold h4" href="{{ route('customer.login') }}"><ins>Login</ins></a>  or</h5>
                            <div class="row">
                                <div class="col-4"><hr></div>
                                <div class="col-4 fw-bold text-center"><h5>Register with</h5></div>
                                <div class="col-4"><hr></div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('google.redirect') }}"><img width="8%" src="{{ asset('frontend/images/icons/google.webp') }}" alt="google"></a>
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

@section('footer_scripts')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection
