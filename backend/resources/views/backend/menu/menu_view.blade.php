@extends('admin.admin_master')
@section('admin_content')
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>description</th>
                            <th>category</th>
                            <th>price</th>
                            <th>discount price</th>
                            <th>thumbnail</th>
                            <th>Ingredients</th>
                            <th>Dietary info</th>
                            <th>In Stock</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->title}}</td>
                                <td>{{$menu->description}}</td>
                                <td>{{$menu->category?->name}}</td>
                                <td>{{$menu->price}}</td>
                                <td>{{$menu->discount_price}}</td>
                                <td>
                                    <img
                                    src="{{$menu->meal_thumbnail}}" width="130px" height="130px"
                                    />
                                </td>
                                <td>{{$menu->ingredients}}</td>
                                <td>{{$menu->dietary_info}}</td>
                                <td>{{$menu->in_stock}}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a href="{{route('menu.edit', $menu->id)}}" class="text-decoration:none">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                        <form action="{{route('menu.delete', $menu->id)}}" method="POST" enctype="multipart/form-data">
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
        </div>
    </div>
</div>
@endsection
