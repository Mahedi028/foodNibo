@extends('admin.admin_master')

@section('admin_content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>disvision</th>
                                    <th>district</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($states as $state)
                                    <tr>
                                        <td>{{$state->id}}</td>
                                        <td>{{$state->name}}</td>
                                        <td>{{$state->division->name}}</td>
                                        <td>{{$state->district->name}}</td>
                                        <td>
                                            <button class="btn btn-info">
                                                <a href="{{route('state.edit', $state->id)}}" class="text-decoration:none">Edit</a>
                                            </button>
                                        </td>
                                        <td>
                                            {{-- <a href="{{route('category.delete', $item->id)}}" id="delete"> --}}
                                                <form action="{{route('state.delete', $state->id)}}" method="POST" enctype="multipart/form-data">
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
                        <h4>State Add</h4>
                        @if(session()->has('message'))
                        <div class="alert alert-{{session('type')}}">
                        {{session('message')}}
                        </div>
                    @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('state.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-control mb-2">
                                <label htmFor="name">Name</label>
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    value=""
                                    placeholder="Enter state name"
                                />
                                @error('name')
                                <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-control mb-2">
                                <label htmFor="name">Divisions</label>
                                <select
                                    class="form-control"
                                    name="division_id"
                                >
                                <option>Select your division</option>
                                @foreach ($divisions as $division)
                                <option value={{$division->id}}>{{$division->name}}</option>
                                @endforeach
                                </select>
                                @error('name')
                                <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-control mb-2">
                                <label htmFor="name">District</label>
                                <select
                                    class="form-control"
                                    name="district_id"
                                >
                                <option>Select your district</option>
                                @foreach ($districts as $district)
                                <option value={{$district->id}}>{{$district->name}}</option>
                                @endforeach
                                </select>
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
