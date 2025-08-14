<x-layout>
    <x-slot:title>Edit product</x-slot:title>
    <x-header></x-header>
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Edit</span> Product</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0 w-75 mx-auto">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="/doeditproduct" enctype="multipart/form-data">
                            @csrf()
                            {{-- id --}}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            {{-- name --}}
                            <p>
                                <input type="text" required placeholder="Name" name="name" class="w-100"
                                    value="{{ old('name') ?? $product->name }}">
                                {{-- name error --}}
                                <span class="text-danger w-100">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            {{-- category --}}
                            <p>
                                <select required name="category_id" class="form-control"
                                    value="{{ old('category_id') ?? $product->category_id }}">
                                    @if (!$product->category_id)
                                        <option selected disabled>Choose category</option>
                                    @endif
                                    @foreach ($categories as $item)
                                        @if ($item->id == $product->category_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {{-- category error --}}
                                <span class="text-danger" class="w-100">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            {{-- price & quantity --}}
                            <p class="d-flex">
                                <input type="number" required placeholder="price" name="price" class="w-50 mr-4"
                                    value="{{ old('price') ?? $product->price }}">
                                <input type="number" required placeholder="quantity" name="quantity" class="w-50"
                                    value="{{ old('quantity') ?? $product->quantity }}">
                            </p>
                            <div class="d-flex">
                                {{-- price error --}}
                                <p class="d-inline w-50 mr-4">
                                    <span class="text-danger" class="w-100">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                {{-- quantity error --}}
                                <p class="d-inline w-50">
                                    <span class="text-danger" class="w-100">
                                        @error('quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                            </div>
                                {{-- Slider --}}
                                {{-- <div>
                                <div id="ImageSlider" class="carousel slide w-25" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($product->images as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image->name) }}" class="w-100"
                                                    style="max-height: 250px; min-height: 250px;" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#ImageSlider" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#ImageSlider" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div> --}}
                                {{-- End Slider --}}
                            {{-- description --}}
                            <p>
                                <textarea name="description" cols="30" rows="10" placeholder="description">{{ old('description') ?? $product->description }}</textarea>
                                {{-- description error --}}
                                <span class="text-danger" class="w-100">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="hidden" name="previousUrl" value="{{ url()->previous() }}">
                            </p>
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
