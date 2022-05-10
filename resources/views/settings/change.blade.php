
@extends('dashboard.dashboard-master')


@section('page_title')
Change Settings
@endsection

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('settings.change') }}">Settings</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('settings.change') }}">Change Settings</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Change Settings</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label><h3>Setting Name</h3></label>
                        </div>
                        <div class="col-9">
                            <label><h3>Setting Value</h3></label>
                        </div>
                        <br>
                        <br>
                        <br>
                        @foreach ($settings as $setting)
                            <div class="col-3 mb-4 mt-3">
                                <label><h4 class="text-primary"">{{ ucfirst(str_replace('_', ' ', $setting->setting_name)) }}</h4></label>
                            </div>
                            <div class="col-9 mb-4">
                                <input value="{{ $setting->setting_value }}" type="text" class="form-control form-control-lg" name="{{ $setting->setting_name }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button id="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-arrow-up text-primary"></i>
                        </span>Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection




