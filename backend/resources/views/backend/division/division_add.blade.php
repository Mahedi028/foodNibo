@extends('admin.admin_master')

@section('admin_content')
    <div class="container mt-2">
        <div class="row mb-2">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive" width="100%">
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
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Division Add</h4>
                        @if(session()->has('message'))
                        <div class="alert alert-{{session('type')}}">
                        {{session('message')}}
                        </div>
                    @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('division.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-control mb-2">
                                <label htmFor="name">Name</label>
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    value=""
                                    placeholder="Enter division name"
                                />
                                @error('name')
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
    </div>
@endsection
