
@extends('dashboard.dashboard-master')


@section('page_title')
Settings Add
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('settings.add') }}">Settings</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('settings.add') }}">Settings Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Settings</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('settings.post') }}" method="POST">
                    @csrf
                    <div class="form-group input-primary">
                        <label><h4>Setting Name</h4></label>
                        <input  type="text" class="form-control form-control-lg" name="setting_name">
                    </div>
                    <div class="form-group input-primary">
                        <label><h4>Setting Value</h4></label>
                        <input type="text" class="form-control form-control-lg" name="setting_value">
                    </div>
                    <div class="form-group">
                        <button id="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="fa fa-plus text-primary"></i>
                        </span>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection




