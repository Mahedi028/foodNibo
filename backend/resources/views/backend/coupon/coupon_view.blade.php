@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Email</th>
                    <th>Coupon Name</th>
                    <th>Coupon Code</th>
                    <th>Coupon Discount</th>
                    <th>Coupon Validity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{$cupon->id}}</td>
                        <td>{{$cupon->email}}</td>
                        <td>{{$cupon->coupon_name}}</td>
                        <td>{{$cupon->coupon_code}}</td>
                        <td>{{$cupon->coupon_discount}}</td>
                        <td>{{$cupon->coupon_validity}}</td>
                        <td>{{$cupon->status}}</td>
                        <td>
                            <button class="btn btn-info">
                                <a href="{{route('coupon.edit', $cupon->id)}}" class="text-decoration:none">Edit</a>
                            </button>
                        </td>
                        <td>
                            {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                <form action="{{route('coupon.delete', $cupon->id)}}" method="POST" enctype="multipart/form-data">
                                     @csrf
                                     @method('delete')
                                     <button class="btn btn-danger" type="submit">
                                        delete
                                        {{-- <a href="{{route('category.delete', $item->id)}}" id="delete">Delete</a> --}}
                                     </button>
                                     </form>
                                     {{-- </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
