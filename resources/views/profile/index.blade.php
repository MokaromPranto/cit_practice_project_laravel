@extends('dashboard.dashboard-master')


@section('page_title')
Profile Settings
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profile') }}">User Profile Settings</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        @if (auth()->user()->profile_photo)
                            <img src="{{ asset('uploads/profile') }}/{{ auth()->user()->profile_photo }}" class="img-fluid rounded-circle" alt="Not Found">
                        @else
                            <img src="{{ asset('dashboard') }}/images/avatar/1.jpg" class="img-fluid rounded-circle" alt="Not Found">
                        @endif
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{ auth()->user()->name }}</h4>
                            <p>Username</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{ auth()->user()->email }}</h4>
                            <p>Email Address</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{ auth()->user()->phone_number }}</h4>
                            <p>Phone Number</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="settings-form">
                    <h4 class="text-primary">Account Setting</h4>
                        <form action="{{ route('change.name') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone Number</label>
                                    <input type="text" value="{{ auth()->user()->phone_number }}" class="form-control" name="phone_number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Profile Photo</label>
                                    <input type="file" class="form-control" name="profile_photo">
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm" type="submit">Change Info</button>
                        </form>
                        <hr>
                        <hr>
                        <hr>
                        <form action="{{ route('change.password') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" name="current_password">

                                    @if (session('error'))
                                        <small class="text-danger">{{ session('error') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <button class="btn btn-secondary btn-sm" type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_scripts')
<script>

    @if (session('success'))
        Swal.fire(
    'Congrats!',
    '{{ session('success') }}',
    'success'
    )
    @endif
</script>
@endsection

