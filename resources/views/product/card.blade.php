@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid mt-4">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl font-bold text-center text-gray-900">Our Products</h1>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            
            <div class="container-fluid px-4">
                <section class="py-2">
                    <div class="container mt-2">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-9">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @forelse ($products->where('status', 'approve') as $product)
                                        <!-- Product card -->
                                        <div class="bg-white rounded-lg shadow relative">
                                            <!-- Product image -->
                                            <img class="w-full h-40 object-cover rounded-t-lg" src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" />
                                            <!-- Sale badge -->
                                            @if ($product['sale_price'] != 0)
                                                <div class="badge bg-success text-white px-2 py-1 rounded-tl-md absolute top-2 right-2">Sale</div>
                                            @endif
                                            <!-- Product details -->
                                            <div class="p-3">
                                                <div class="text-center">
                                                    <!-- Product name -->
                                                    <a href="{{ route('product.show', ['id' => $product->id]) }}" style="text-decoration: none;" class="text-dark">
                                                        <small class="font-semibold">{{ $product->category->name }}</small>
                                                        <h6 class="font-bold">{{ $product->name }}</h6>
                                                    </a>
                                                    <!-- Product reviews -->
                                                    <div class="flex justify-center items-center text-yellow-500 space-x-1 mt-2">
                                                        @for ($i = 0; $i < $product->rating; $i++)
                                                            <div class="bi-star-fill"></div>
                                                        @endfor
                                                    </div>
                                                    <!-- Product price -->
                                                    <div class="mt-2">
                                                        @if ($product['sale_price'] != 0)
                                                            <span class="text-xs line-through text-gray-500">Rp.{{ number_format($product->price, 0) }}</span>
                                                            <span class="text-lg font-semibold text-gray-900">Rp.{{ number_format($product->sale_price, 0) }}</span>
                                                        @else
                                                            <span class="text-lg font-semibold text-gray-900">Rp.{{ number_format($product->price, 0) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product actions -->
                                            <div class="p-3 border-t bg-transparent">
                                                <div class="text-center">
                                                    <a class="inline-block bg-green-500 text-white px-4 py-2 rounded-md no-underline" href="#">
                                                        <i class="bi-cart-fill me-1"></i>
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="bg-white rounded-lg shadow p-3 col-span-3">
                                            <div class="alert alert-secondary w-full text-center" role="alert">
                                                <h4>Produk belum tersedia</h4>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
    
                            <div class="col-md-3 mb-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Price</h5>
                                                <form action="{{ route('product.index') }}" method="GET">
                                                    @csrf
                                                    <div class="row g-3 my-2">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" placeholder="Min" name="min" value="{{ old('min') }}">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" placeholder="Max" name="max" value="{{ old('max') }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
