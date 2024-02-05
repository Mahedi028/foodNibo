@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <div class="row mb-2">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table className='table'>
                            <tr>
                                <th>Name:</th>
                                <th>{{$order->name}}</th>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <th>{{$order->email}}</th>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <th>{{$order->phone}}</th>
                            </tr>
                            <tr>
                                <th>Division:</th>
                                <th>{{$order->division->name}}</th>
                            </tr>
                            <tr>
                                <th>District:</th>
                                <th>{{$order->district->name}}</th>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <th>{{$order->state->name}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table className='table'>
                            <tr>
                                <th>Payment Type:</th>
                                <th>{{$order->payment_type}}</th>
                            </tr>
                            <tr>
                                <th>TrxId:</th>
                                <th>{{$order->transaction_id}}</th>
                            </tr>
                            <tr>
                                <th>Invoice:</th>
                                <th>{{$order->invoice_no}}</th>
                            </tr>
                            <tr>
                                <th>Order Number:</th>
                                <th>{{$order->order_number}}</th>
                            </tr>
                            <tr>
                                <th>Order Date:</th>
                                <th>{{$order->district->name}}</th>
                            </tr>
                            <tr>
                                <th>Operational Status:</th>
                                <th>{{$order->operational_status}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table className='table table-bodered'>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Menu Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)
                                <tr>
                                    <td>
                                        <img src={{$item->menu->meal_thumbnail}}/>
                                    </td>
                                    <td>{{$item->menu->title}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
