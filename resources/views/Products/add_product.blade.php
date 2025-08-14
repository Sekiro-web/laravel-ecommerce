<x-layout>
    <x-slot:title>Add product</x-slot:title>
    <x-header></x-header>
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Product</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0 w-75 mx-auto">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="/storeproduct" enctype="multipart/form-data">
                            @csrf
                            {{-- Name --}}
                            <p>
                                <input type="text" required placeholder="Name" name="name" class="w-100"
                                    value="{{ old('name') }}">
                                <span class="text-danger w-100">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            {{-- Category --}}
                            <p>
                                <select required name="category_id" class="form-control">
                                    <option selected disabled>Choose category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger w-100">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            {{-- Price & Quantity --}}
                            <p class="d-flex">
                                <input type="number" required placeholder="Price" name="price" class="w-50 mr-4"
                                    value="{{ old('price') }}">
                                <input type="number" required placeholder="Quantity" name="quantity" class="w-50"
                                    value="{{ old('quantity') }}">
                            </p>
                            <div class="d-flex">
                                <p class="d-inline w-50 mr-4">
                                    <span class="text-danger w-100">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                <p class="d-inline w-50">
                                    <span class="text-danger w-100">
                                        @error('quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                            </div>
                            {{-- Images --}}
                            <p>
                                <input type="file" name="images[]" multiple accept="image/*">
                            </p>
                            <p>
                                <span class="text-danger w-100">
                                    @error('images')
                                        {{ $message }}
                                    @enderror
                                </span>
                                @foreach ($errors->get('images.*') as $fileErrors)
                                    @foreach ($fileErrors as $error)
                                        <span class="text-danger w-100">{{ $error }}</span>
                                    @endforeach
                                @endforeach
                            </p>
                            {{-- Description --}}
                            <p>
                                <textarea name="description" cols="30" rows="10" placeholder="Description">{{ old('description') }}</textarea>
                                <span class="text-danger w-100">
                                    @error('description')
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
</x-layout>
