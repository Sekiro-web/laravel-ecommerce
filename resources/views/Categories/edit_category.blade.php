<x-layout>
    <x-slot:title>Add product</x-slot:title>
    <x-header></x-header>
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Category</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0 w-75 mx-auto">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="/doeditCategory" enctype="multipart/form-data">
                            @csrf()
                            {{-- id --}}
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            {{-- name --}}
                            <p>
                                <input type="text" required placeholder="Name" name="name" class="w-100"
                                    value="{{ old('name') ?? $category->name }}">
                                {{-- name error --}}
                                <span class="text-danger w-100">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="file" name="imgpath">
                                <img src="{{ asset($category->imgpath) }}"
                                    style="max-height: 250px; min-height: 250px;">
                            </p>
                            {{-- image error --}}
                            <p class="d-inline w-50 mr-4">
                                <span class="text-danger" class="w-100">
                                    @error('imgpath')
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
