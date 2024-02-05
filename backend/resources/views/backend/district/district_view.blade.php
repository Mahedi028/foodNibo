@extends('admin.admin_master')
@section('admin_content')
    <div class="container mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>states</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($districts as $district)
                    <tr>
                        <td>{{$district->id}}</td>
                        <td>{{$district->name}}</td>
                        <td>
                            <ol>
                                @foreach ($district->states as $state)
                                    <li>{{$state->name}}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>
                            <button class="btn btn-info">
                                <a href="{{route('district.edit', $district->id)}}" class="text-decoration:none">Edit</a>
                            </button>
                        </td>
                        <td>
                            {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                <form action="{{route('district.delete', $district->id)}}" method="POST" enctype="multipart/form-data">
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
