
@extends('dashboard.dashboard-master')

@section('page_title')
Dashboard
@endsection()

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">Widget</a></li> --}}
        <li class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></li>
    </ol>
</div>
<!-- row -->
<div class="row">
    <div class="col-xl-3 col-lg-3 col-sm-3">
        <div class="card">
            <div class="social-graph-wrapper bg-primary">
                <span class="s-icon"><i class="fa fa-users"></i>  Total Users</span>
            </div>
            <div class="row">
                <div class="col-6 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_admins }}</span></h3>
                        <p class="m-0 font-weight-bold">Admins</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_customers }}</span></h4>
                        <p class="m-0  font-weight-bold">Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-sm-3">
        <div class="card">
            <div class="social-graph-wrapper bg-danger">
                <span class="s-icon"><i class="fa fa-list"></i>  Variations</span>
            </div>
            <div class="row">
                <div class="col-6 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_colors }}</span></h3>
                        <p class="m-0 font-weight-bold">Colors</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_sizes }}</span></h4>
                        <p class="m-0  font-weight-bold">Sizes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-sm-3">
        <div class="card">
            <div class="social-graph-wrapper bg-warning">
                <span class="s-icon"><i class="fa fa-money"></i>  Sales</span>
            </div>
            <div class="row">
                <div class="col-6 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_paid_sale }}</span></h3>
                        <p class="m-0 font-weight-bold">Paid</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_pending_sale }}</span></h4>
                        <p class="m-0  font-weight-bold">Pending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-sm-3">
        <div class="card">
            <div class="social-graph-wrapper bg-info">
                <span class="s-icon"><i class="fa fa-cart-plus"></i>  Orders</span>
            </div>
            <div class="row">
                <div class="col-4 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_processing_order }}</span></h3>
                        <p class="m-0 font-weight-bold">Processing</p>
                    </div>
                </div>
                <div class="col-4 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_pickup_order }}</span></h3>
                        <p class="m-0 font-weight-bold">Pickup</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <h3 class="m-1"><span class="counter">{{ $total_delivered_order }}</span></h4>
                        <p class="m-0  font-weight-bold">Delivered</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-secondary">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="fa fa-th"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Categories</p>
                        <h3 class="text-white">{{ $total_active_categories }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="fa fa-th-list"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Subcategories</p>
                        <h3 class="text-white">{{ $total_active_subcategories }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="fa fa-cubes"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Total Products</p>
                        <p class="mb-1"></p>
                        <h3 class="text-white">{{ $total_products }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Paid Vs Pending Orders</h4>
            </div>
            <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="paid_pending_chart" width="483" height="100" style="display: block; height: 150px; width: 725px;" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
<script>

    // Chart Start
    const labels = [
        'Paid',
        'Pending',
    ];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Paid Vs Pending',
            backgroundColor: ['#F94687','#0B2A97'],
            data: [{{ $paid_order }},{{ $pending_order }}],
        }]
    };
    const config = {
        type: 'doughnut',
        data: data,
        options: {}
    };
    const paid_pending_chart = new Chart(
        document.getElementById('paid_pending_chart'),
        config
    );
    // Chart End


    // Profile Update Message //
    @if (!auth()->user()->phone_number)
        Swal.fire(
    '',
    'Please Update Your Profile!',
    'info'
    )
    @endif
</script>
@endsection
