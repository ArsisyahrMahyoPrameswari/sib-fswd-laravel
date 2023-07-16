@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl text-gray-900">Category</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="mt-2">
            @if (Auth::user()->role->name == 'Admin')
            <a class="btn btn-primary mt-4" href="{{ route('category.create') }}" role="button">Create New</a>
            @endif
            <div class="card mt-2">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                @if (Auth::user()->role->name == 'Admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    @if (Auth::user()->role->name == 'Admin')
                                    <td>
                                        <form onsubmit="return confirm('Are you sure? ');" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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