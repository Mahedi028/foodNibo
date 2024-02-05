@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>districts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($divisions as $division)
                    <tr>
                        <td>{{$division->id}}</td>
                        <td>{{$division->name}}</td>
                        <td>
                            <ol>
                            @foreach ($division->districts as $district)
                                <li>{{$district->name}}</li>
                            @endforeach
                            </ol>
                        </td>
                        <td>
                            <button class="btn btn-info">
                                <a href="{{route('division.edit', $division->id)}}" class="text-decoration:none">Edit</a>
                            </button>
                        </td>
                        <td>
                            {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                <form action="{{route('division.delete', $division->id)}}" method="POST" enctype="multipart/form-data">
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
