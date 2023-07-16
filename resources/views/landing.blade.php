<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pet Shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- Add Tailwind CSS CDN link here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <div class="container px-4 px-lg-5">
        <h4 class="logo-brand"><i class="fas fa-cat" style="color: white;"></i><span class="text-light"> Pet Shop</span></h4>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="#!">Home</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('landing', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <form class="d-flex flex-grow-1 mx-lg-4" action="{{ route('landing') }}" method="GET">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search for products..." aria-label="Search" name="search" onchange="this.form.submit()">
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light me-1" href="#">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-1">
                            <i class="bi-person-fill me-1"></i>
                            Dashboard
                        </a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="bi-person-fill me-1"></i>
                            Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>



    <!-- Carousel-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($sliders as $slider)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->iteration - 1 }}" class="{{ $loop->first ? 'active' : '' }}"
                    aria-current="{{ $loop->first ? 'true' : '' }}" aria-label="Slide 1"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
    @foreach ($sliders as $slider)
        @if ($slider->status == 'approve')
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                <img src="{{ asset('storage/slider/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->image }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $slider->title }}</h5>
                    <p>{{ $slider->caption }}</p>
                </div>
            </div>
        @endif
    @endforeach
</div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="py-5">
        <div class="container mt-2">
            <!-- Price Filter -->
            <div class="row mb-3">
                <div class="col">
                    <div class="card mb-1">
                        <div class="card-body">
                            <h5 class="card-title">Price</h5>
                            <form action="{{ route('landing') }}" method="GET">
                                @csrf
                                <div class="row g-3 my-2">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Min" name="min"
                                            value="{{ old('min') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Max" name="max"
                                            value="{{ old('max') }}">
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

            <!-- Our Product -->
            <h3 class="text-center">Our Product</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($products->where('status', 'approve') as $product)
                    <!-- Product card -->
                    <div class="bg-white rounded-lg shadow relative">
                        <!-- Sale badge -->
                        @if ($product['sale_price'] != 0)
                            <!-- Sale badge-->
                            <div class="badge bg-success text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        @endif
                        <!-- Product image -->
                        <img class="w-full h-40 object-cover rounded-t-lg" src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" />
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
    </section>



    <!-- Footer-->
      <!-- Footer -->
      <footer class="bg-primary text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Contact</h5>
                <ul class="list-unstyled">
                    <li>Email: info@petshop.com</li>
                    <li>Phone: +1 123 456 7890</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="bi-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Address</h5>
                <p>1234 Pet Street, City, Country</p>
            </div>
        </div>
    </div>
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    {{-- <script src="js/scripts.js"></script> --}}
</body>

</html>