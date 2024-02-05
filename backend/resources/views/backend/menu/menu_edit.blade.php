@extends('admin.admin_master')

@section('admin_content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h4>Menu Edit</h4>
            @if(session()->has('message'))
            <div class="alert alert-{{session('type')}}">
            {{session('message')}}
            </div>
        @endif
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('menu.update',$menu->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-control mb-2">
                    <label htmFor="title">Title</label>
                    <input
                        id="title"
                        type="text"
                        class="form-control"
                        name="title"
                        value="{{$menu->title ? $menu->title:''}}"
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
                    {{$menu->description ? $menu->description:''}}
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
                            value="{{$menu->price ? $menu->price:''}}"
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
                            value="{{$menu->discount_price ? $menu->discount_price:''}}"
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
                            value={{$menu->active}}
                        >
                            <option>Select</option>
                            <option value=1 {{$menu->active==1?'selected':''}}>active</option>
                            <option value=0 {{$menu->active==0?'selected':''}}>Inactive</option>
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
                            value={{$menu->in_stock}}
                        >
                            <option>Select</option>
                            <option value="1" {{$menu->in_stock==1 ? 'selected':''}}>yes</option>
                            <option value="0" {{$menu->in_stock==0 ? 'selected':''}}>no</option>
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
                        value={{$menu->category_id}}
                    >
                    <option>Select your category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}"{{$menu->category_id==$category->id ? 'selected':''}}>{{$category->name}}</option>
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
                    >update</button>
            </form>
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
