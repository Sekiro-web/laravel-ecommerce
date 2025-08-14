<x-layout>
    <x-slot:title>Product details</x-slot:title>
    <x-header></x-header>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Product Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        {{-- Slider --}}
                        <div id="ImageSlider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->name) }}" class="w-100" style="height: 500px"
                                            alt="Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#ImageSlider" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#ImageSlider" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        {{-- End Slider --}}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        {{-- Name --}}
                        <h3>{{ $product->name }}</h3>
                        {{-- Price --}}
                        <div>
                            <p class="d-inline-block single-product-pricing">Price: </p>
                            <p class="d-inline-block" style="font-size: 20px"> ${{ $product->price }}</p>
                        </div>
                        {{-- Description --}}
                        <p>{{ $product->description }}</p>
                        <div class="single-product-form">
                            <form action="" method="POST">
                                <input type="number" placeholder="0">
                            </form>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                            {{-- Category --}}
                            <p><strong>Categories: </strong>{{ $product->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related_products as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('productDetails', ['id' => $item->id]) }}">
                                    <img src="{{ asset($item->firstImage->name) }}" style="max-height: 250px"
                                        alt="Product Image">
                                </a>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p class="product-price">{{ $item->price }}</p>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
    <x-logo_carousel></x-logo_carousel>
</x-layout>
