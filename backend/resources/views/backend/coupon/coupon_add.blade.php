@extends('admin.admin_master')

@section('admin_content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h4>Coupon Add</h4>
                @if(session()->has('message'))
                <div class="alert alert-{{session('type')}}">
                {{session('message')}}
                </div>
            @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('coupon.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control mb-2">
                        <label htmFor="name">Coupon Name</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control"
                            name="coupon_name"
                            value=""
                            placeholder="Enter coupon name"
                        />
                        @error('coupon_name')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="name">Coupon Discount</label>
                        <input
                            id="name"
                            type="number"
                            class="form-control"
                            name="coupon_discount"
                            value=""
                            placeholder="Enter coupon discount"
                        />
                        @error('coupon_discount')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="name">Coupon Discount Price</label>
                        <input
                            id="name"
                            type="number"
                            class="form-control"
                            name="discount_price"
                            value=""
                            placeholder="Enter coupon discount"
                        />
                        @error('coupon_discount')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="name">Coupon Validity</label>
                        <input
                            id="name"
                            type="date"
                            class="form-control"
                            name="coupon_validity"
                            value=""
                            placeholder="Enter coupon validity"
                            min="{{\Carbon\Carbon::now()}}"
                        />
                        @error('coupon_discount')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-control mb-2">
                        <label>Status</label>
                        <select
                            name="status"
                            class="form-control"
                        >
                            <option>Select</option>
                            <option value="1">active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('active')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                        <button
                        type="submit"
                        class="btn btn-info"
                        >Add</button>
                </form>
            </div>
        </div>
    </div>



@endsection

