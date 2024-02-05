@extends('admin.admin_master')
@section('admin_content')
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>slug</th>
                            <th>thumbnail</th>
                            <th>description</th>
                            <th>Related menus</th>
                            <th>active</th>
                            <th>featured</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    <img
                                    src="{{$category->category_thumbnail}}" width="130px" height="130px"
                                    />
                                </td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <ol>
                                        @foreach ($category->menus as $menu)
                                            <li>{{$menu->title}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>{{$category->active}}</td>
                                <td>{{$category->featured}}</td>
                                <td>
                                    <button class="btn btn-info">
                                        <a href="{{route('category.edit', $category->id)}}" class="text-decoration:none">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                        <form action="{{route('category.delete', $category->id)}}" method="POST" enctype="multipart/form-data">
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
