@extends('admin.admin_master')

@section('admin_content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h4>Banner Add</h4>
                @if(session()->has('message'))
                <div class="alert alert-{{session('type')}}">
                {{session('message')}}
                </div>
            @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control mb-2">
                        <label htmFor="image">Banner</label>
                        <input
                            id="image"
                            type="file"
                            class="form-control"
                            name="banner_thumbnail"
                            value=""
                        />
                    </div>
                    <div class="mb-3">
                        <img
                        id="showImage"
                        src="{{url('upload/no_image.jpg')}}"
                        style="width:100px; height:100px;"
                        />
                    </div>
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

