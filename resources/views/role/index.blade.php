@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
        <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl text-gray-900">Role</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="mt-2">
            
            <a href="{{ route('role.create') }}" class="btn btn-primary mt-4">Create New</a>

            <div class="card mt-2">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                @if (Auth::user()->role->name == 'Admin')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    @if (Auth::user()->role->name == 'Admin')
                                    <td>
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection