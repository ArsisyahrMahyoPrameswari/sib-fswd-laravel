@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl text-gray-900">User</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="mt-2">

            <a href="{{ route('user.create') }}" class="btn btn-primary mt-4">Create User</a>

            <div class="card mt-2">
                <div class="card-body">
                <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <span class="badge {{ $user->role ? ($user->role->name == 'Admin' ? 'bg-info' : ($user->role->name == 'Staff' ? 'bg-primary' : ($user->role->name == 'User' ? 'bg-success' : 'bg-warning'))) : 'bg-danger' }}">
                                            {{ $user->role ? $user->role->name : 'Tidak Tersedia' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->image == null)
                                            <span class="badge bg-primary">No Image</span>
                                        @else
                                            <img src="{{ asset('storage/user/' . $user->image) }}" alt="{{ $user->name }}" style="max-width: 50px">
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection