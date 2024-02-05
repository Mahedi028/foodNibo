@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>id</th>
                    <th>banners</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>
                            <img
                            src="{{$banner->banner_thumbnail}}" width="130px" height="130px"
                            />
                        </td>

                        <td>
                            <button class="btn btn-info">
                                <a href="{{route('banner.edit', $banner->id)}}" class="text-decoration:none">Edit</a>
                            </button>
                        </td>
                        <td>
                            {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                <form action="{{route('banner.delete', $banner->id)}}" method="POST" enctype="multipart/form-data">
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
