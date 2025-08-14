<x-layout>
    <x-slot:title>About</x-slot:title>
    <x-header></x-header>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    {{-- <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h2 class="pb-3">Why <span class="orange-text">Fruitkha</span></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Home Delivery</h3>
                                        <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque
                                            ipsa quae ab illo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Best Price</h3>
                                        <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque
                                            ipsa quae ab illo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Custom Box</h3>
                                        <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque
                                            ipsa quae ab illo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h3>Quick Refund</h3>
                                        <p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque
                                            ipsa quae ab illo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end featured section --> --}}

    {{-- <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner --> --}}

    {{-- <!-- team section -->
    <div class="mt-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Our <span class="orange-text">Team</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-1"></div>
                        <h4>Jimmy Doe <span>Farmer</span></h4>
                        <ul class="social-link-team">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-2"></div>
                        <h4>Marry Doe <span>Farmer</span></h4>
                        <ul class="social-link-team">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                    <div class="single-team-item">
                        <div class="team-bg team-bg-3"></div>
                        <h4>Simon Joe <span>Farmer</span></h4>
                        <ul class="social-link-team">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end team section --> --}}

    <!-- testimonail-section -->
    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">What Customers Say </span> About Us</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="testimonial-sliders">
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
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->
    <!-- feedback form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Submit</span> Feedback</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Have something in mind?</h2>
                        <p>We are more than happy to receive your feedback</p>
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="/storefeedback" id="fruitkha-contact">
                            @csrf
                            {{-- name & email --}}
                            <p class="d-flex">
                                <input type="text" required placeholder="Name" name="name" id="name"
                                    value="{{ old('name') }}" class="w-50 mr-4">
                                <input type="email" required placeholder="Email" name="email" id="email"
                                    value="{{ old('email') }}" class="w-50">
                            </p>
                            <div class="d-flex">
                                {{-- name error --}}
                                <p class="d-inline w-50 mr-4">
                                    <span class="text-danger" class="w-100">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                {{-- email error --}}
                                <p class="d-inline w-50">
                                    <span class="text-danger" class="w-100">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                            </div>
                            <p>
                                <input type="text" required placeholder="Subject" name="subject" id="subject"
                                    value="{{ old('subject') }}" class="w-100">
                                {{-- subject error --}}
                                <span class="text-danger w-100">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message">{{ old('message') }}</textarea>
                                {{-- message error --}}
                                <span class="text-danger" class="w-100">
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end feedback form -->
    <x-logo_carousel></x-logo_carousel>
</x-layout>
