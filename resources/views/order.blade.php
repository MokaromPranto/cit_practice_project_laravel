@extends('dashboard.dashboard-master')

@section('page_title')
Orders
@endsection()


@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('order') }}">Orders</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Order List</h3>
            </div>
            <div class="row mx-2 mt-4">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-primary">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="order_list_datatable">
                    <thead class="thead-inverse">
                        <tr>
                            <th><h4>Customer Name</h4></th>
                            <th><h4>Customer Country</h4></th>
                            <th><h4>Customer City</h4></th>
                            <th><h4>Payment Method</h4></th>
                            <th><h4>Payment Status</h4></th>
                            <th><h4>Delivery Status</h4></th>
                            <th><h4>Grand Total</h4></th>
                            <th><h4>Action</h4></th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse ( $order_details as $order_detail )
                            <tr>
                                <td>{{ $order_detail->customer_name }}</td>
                                <td>{{ $order_detail->customer_country }}</td>
                                <td>{{ $order_detail->customer_city }}</td>
                                <td>{{ $order_detail->payment_method }}</td>
                                <td>{{ $order_detail->payment_status }}</td>
                                <td>{{ $order_detail->delivery_status }}</td>
                                <td>{{ $order_detail->grand_total }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            Change Order Status
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(210px, 57px, 0px);">
                                            <a class="dropdown-item" href="{{ route('order.change.status', [
                                                'order_id' => $order_detail->id,
                                                'delivery_status' => 'processing'
                                            ]) }}">Processing</a>
                                            <a class="dropdown-item" href="{{ route('order.change.status', [
                                                'order_id' => $order_detail->id,
                                                'delivery_status' => 'pickup'
                                            ]) }}">Pickup</a>
                                            <a class="dropdown-item" href="{{ route('order.change.status', [
                                                'order_id' => $order_detail->id,
                                                'delivery_status' => 'delivered'
                                            ]) }}">Delivered</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr class="text-danger text-center">
                                    <td colspan="50">No Orders To Show!</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('footer_scripts')
<script>
    $(document).ready(function() {
        $('#order_list_datatable').DataTable();
    } );
</script>
@endsection

