@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Operational Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->order_date}}</td>
                        <td>{{$order->invoice_no}}</td>
                        <td>{{$order->total_amount}}</td>
                        <td>{{$order->payment_type}}</td>
                        <td>{{$order->operational_status}}</td>
                        <td>
                            <button class="btn btn-info">
                                <a href="{{route('pending.order.details', $order->id)}}" class="text-decoration:none">Edit</a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
