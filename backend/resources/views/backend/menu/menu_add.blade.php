@extends('admin.admin_master')

@section('admin_content')

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-10 col-lg-offset-2 p-1">
        <div class="card">
            <div class="card-header">
                <h4>Menu Add</h4>
                @if(session()->has('message'))
                <div class="alert alert-{{session('type')}}">
                {{session('message')}}
                </div>
            @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('menu.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control mb-2">
                        <label htmFor="title">Title</label>
                        <input
                            id="title"
                            type="text"
                            class="form-control"
                            name="title"
                            value=""
                            placeholder="Enter menu title"
                        />
                        @error('title')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
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
                    <div class="row mb-2">
                        <div class="col col-md-6 col-lg-6 ">
                            <label htmFor="price">Price</label>
                            <input
                                id="price"
                                type="number"
                                class="form-control"
                                name="price"
                                value=""
                                placeholder="Enter menu price"
                            />
                            @error('price')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col col-md-6 col-lg-6">
                            <label htmFor="discount_price">Discount Price</label>
                            <input
                                id="discount_price"
                                type="number"
                                class="form-control"
                                name="discount_price"
                                value=""
                                placeholder="Enter menu discount_price"
                            />
                            @error('discount_price')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-control mb-2">
                        <label htmFor="image">Menu Thumbnail</label>
                        <input
                            id="image"
                            type="file"
                            class="form-control"
                            name="meal_thumbnail"
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
                    <div class="row mb-2">
                        <div class="col col-md-4 col-lg-4">
                            <label htmFor="image1">Menu Image1</label>
                            <input
                                id="image1"
                                type="file"
                                class="form-control"
                                name="meal_img1"
                                value=""
                            />
                            <div class="mb-3">
                                <img
                                id="showImage"
                                src="{{url('upload/no_image.jpg')}}"
                                style="width:100px; height:100px;"
                                />
                            </div>
                        </div>
                        <div class="col col-md-4 col-lg-4">
                            <label htmFor="image2">Menu Image2</label>
                            <input
                                id="image2"
                                type="file"
                                class="form-control"
                                name="meal_img2"
                                value=""
                            />
                            <div class="mb-3">
                                <img
                                id="showImage"
                                src="{{url('upload/no_image.jpg')}}"
                                style="width:100px; height:100px;"
                                />
                            </div>
                        </div>
                        <div class="col col-md-4 col-lg-4">
                            <label htmFor="image3">Menu Image3</label>
                            <input
                                id="image3"
                                type="file"
                                class="form-control"
                                name="meal_img3"
                                value=""
                            />
                            <div class="mb-3">
                                <img
                                id="showImage"
                                src="{{url('upload/no_image.jpg')}}"
                                style="width:100px; height:100px;"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col col-md-6 col-lg-6">
                            <label>Availity</label>
                            <select
                                name="active"
                                class="form-control"
                            >
                                <option>Select</option>
                                <option value=1>active</option>
                                <option value=0>Inactive</option>
                            </select>
                            @error('active')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col col-md-6 col-lg-6">
                            <label>InStock</label>
                            <select
                                name="in_stock"
                                class="form-control"
                            >
                                <option>Select</option>
                                <option value="1">yes</option>
                                <option value="0">no</option>
                            </select>
                            @error('featured')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-control mb-2">
                        <label>Category</label>
                        <select
                            name="category_id"
                            class="form-control"
                        >
                        <option>Select your category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        </select>
                        @error('category_id')
                        <span class="alert alert-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="row mb-2">
                        <div class="col col-md-5 col-lg-5">
                            <label class="form-label">Ingredients</label>
                            <div class="bootstrap-tagsinput">
                                <input
                                name="ingredients"
                                type="text"
                                class="form-control visually-hidden"
                                data-role="tagsinput"
                                value="Red,Black,Pink"
                                multiple
                                >
                        </div>
                        <div class="col col-md-5 col-lg-5">
                            <label class="form-label">Diate</label>
                            <div class="bootstrap-tagsinput">
                                <input
                                name="dietary_info"
                                type="text"
                                class="form-control visually-hidden"
                                data-role="tagsinput"
                                value="Fat,Sugars,Protein"
                                multiple
                                >

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
