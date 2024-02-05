@extends('admin.admin_master')

@section('admin_content')
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-8 col-lg-offset-4 p-1">
        <div class="card">
            <div class="card-header">
                <h4>category Edit</h4>
                    @if(session()->has('message'))
                        <div class="alert alert-{{session('type')}}">
                        {{session('message')}}
                        </div>
                    @endif
            </div>
            <div class="card-body">
                <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-control mb-2">
                        <label htmFor="name">Name</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{$category->name?$category->name:''}}"
                            placeholder="Enter category name"
                        />
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="thumbnail">Thumbnail</label>
                        <input
                            id="thumbnail"
                            type="file"
                            class="form-control"
                            name="category_thumbnail"
                            value=""
                        />
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="description">Description</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter your description"
                        >
                        {{$category->description?$category->description:''}}
                        </textarea>
                    </div>
                    <div class="form-control mb-2">
                        <label>Availity</label>
                        <select
                            name="active"
                            class="form-control"
                        >
                            <option>Select</option>
                            <option value="{{$category->active}}" {{$category->active==$category->active? 'selected':''}}>{{$category->active}}</option>
                            <option value="active">active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-control mb-2">
                        <label>Featured</label>
                        <select
                            name="featured"
                            class="form-control"
                        >
                            <option>Select</option>
                            <option value="{{$category->featured}}" {{$category->featured==$category->featured? 'selected':''}}>{{$category->featured}}</option>
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                        <button
                        type="submit"
                        class="btn btn-info"
                        >Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
