@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">All Orders</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">All Orders</li>
                </ol>
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congrats!</strong> {{ session()->get('message'); }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>OPS!</strong> {{ session()->get('error'); }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header d-flex" style="justify-content: space-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            All Orders
                        </div>
                        <div>
                            <a href="/orders" class="btn btn-primary">Add Order</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Order Amount</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Customer</th>
                                    <th>Order Amount</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($orders as $order)    
                                    <tr>
                                        <td>{{ $order->customer_id }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        @if ($order->paid == 0)
                                            <td>Not Paid</td>
                                        @elseif ($order->paid == 1)
                                            <td>Order Paid</td>
                                        @endif
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            @if ($order->paid == 0)
                                                <a href="/orders/paid?id={{ $order->id }}" class="btn btn-primary mb-2">Mark paid</a>
                                            @elseif ($order->paid == 1)
                                            <a href="/orders/unpaid?id={{ $order->id }}" class="btn btn-warning mb-2">Mark unPaid</a>
                                            @endif
                                            &nbsp;
                                            <a href="/orders/destroy?id={{ $order->id }}" class="btn btn-danger">DELETE</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>
</div>
@endsection
