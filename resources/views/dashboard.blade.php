@extends('layouts.main')

@section('content')
    <main>
    <div class="container-fluid px-4">
    <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl text-gray-900">Dahsboard</h1>
                        </div>
                    </div>
                </div>
                
            </div>
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4 class="card-title">Total Product: {{ $totalProduct }}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4 class="card-title">Total Brand: {{ $totalBrand }}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4 class="card-title">Total Category: {{ $totalCategory }}</h4>
                </div>
            </div>
        </div>
        @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Staff')
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4 class="card-title">Total User: {{ $totalUser }}</h4>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
        <div class="container-fluid px-4">
        <h3 class="text-3xl text-gray-900">Product</h3>
            <div class="row">
                <div class="col">
                    <div clas s="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Nama</th>
                                        <th>Price</th>
                                        <th>Sale Price</th>
                                        <th>Stock</th>
                                        <th>Rating</th>
                                        <th>Brand</th>
                                        <th>Image</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>Rp. {{ number_format($product->price, 0, 2) }}</td>
                                            <td>Rp. {{ number_format($product->sale_price, 0, 2) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->rating }}</td>
                                            <td>{{ $product->brands }}</td>
                                            <td>
                                                @if ($product->image == null)
                                                    <span class="badge bg-primary">No Image</span>
                                                @else
                                                    <img src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 50px">
                                                @endif
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </main>
@endsection
