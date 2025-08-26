<x-layout>
    @push('custom-css')
        <style>
            .single-product-item {
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                transition: all 0.2s ease-in-out;
            }

            .single-product-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .product-image img {
                object-fit: cover;
                border-radius: 8px;
            }

            .single-product-item h3 {
                font-size: 1.2rem;
                margin-top: 15px;
                font-weight: 600;
            }
        </style>
    @endpush
    <x-slot:title>Products</x-slot:title>
    <x-header></x-header>
    <!-- home page slider -->
    <div class="homepage-slider">
        @foreach ($SliderImages as $item)
            <!-- single home slider -->
            <div class="single-homepage-slider homepage-bg"
                style="background-image:url('{{ asset('assets/img/' . $item->imgpath) }}')">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                            <div class="hero-text">
                                <div class="hero-text-tablecell">
                                    {{-- <p class="subtitle"></p> --}}
                                    <h1>{{ $item->text }}</h1>
                                    <div class="hero-btns">
                                        <a href="{{ route('products') }}" class="boxed-btn">Our Products</a>
                                        <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- end home page slider -->
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over $75</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>
                            <span class="orange-text">What We</span>
                            <a href="{{ route('products') }}"> Sell</a>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ route('products', ['name' => $item->name]) }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ asset($item->imgpath) }}" class="img-fluid w-100"
                                        style="height: 250px; object-fit: cover;" alt="404">
                                </div>
                                <h3>{{ $item->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->
    <!-- testimonail-section -->
    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">What Customers Say </span><a href="{{ route('about') }}">About
                                Us</a></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    @if ($Feedback->isNotEmpty())
                        <div class="{{ $Feedback->count() > 1 ? 'testimonial-sliders' : '' }}">
                            @foreach ($Feedback as $item)
                                <div class="single-testimonial-slider">
                                    <div class="client-avater">
                                        <img src="{{ asset('assets/img/avaters/avatar1.png') }}" alt="404">
                                    </div>
                                    <div class="client-meta">
                                        {{-- name --}}
                                        <h3>{{ $item->name }}</h3>
                                        {{-- Subject --}}
                                        <p>{{ $item->subject }}</p>
                                        {{-- message --}}
                                        <p class="testimonial-body">{{ $item->message }}</p>
                                        <div class="last-icon">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div>
                            <h3>Be The First To <a href="{{ route('about') }}">Submit</a></h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->
    <x-logo_carousel></x-logo_carousel>
</x-layout>
