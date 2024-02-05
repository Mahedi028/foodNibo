@extends('admin.admin_master')

@section('admin_content')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-8 col-lg-offset-4 p-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Category Add</h4>
                    @if(session()->has('message'))
                    <div class="alert alert-{{session('type')}}">
                    {{session('message')}}
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control mb-2">
                            <label htmFor="name">Name</label>
                            <input
                                id="name"
                                type="text"
                                class="form-control"
                                name="name"
                                value=""
                                placeholder="Enter category name"
                            />
                            @error('name')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control mb-2">
                            <label htmFor="image">Thumbnail</label>
                            <input
                                id="image"
                                type="file"
                                class="form-control"
                                name="category_thumbnail"
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
                        <div class="form-control mb-2">
                            <label htmFor="description">Description</label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="3"
                                placeholder="Enter your description"
                            >
                            </textarea>
                            @error('description')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control mb-2">
                            <label>Availity</label>
                            <select
                                name="active"
                                class="form-control"
                            >
                                <option>Select</option>
                                <option value="active">active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('active')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control mb-2">
                            <label>Featured</label>
                            <select
                                name="featured"
                                class="form-control"
                            >
                                <option>Select</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                            @error('featured')
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
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader=new FileReader();
                reader.onload=function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection

