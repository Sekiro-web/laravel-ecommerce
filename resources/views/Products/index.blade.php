<x-layout>
    <link rel="stylesheet" href="{{ asset('panel_assets/css/dialog.css') }}">
    <x-slot:title>Products</x-slot:title>
    <x-header></x-header>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="{{ is_null($active_id) ? 'active' : '' }}">
                                <a href="{{ url('products') }}">All</a>
                            </li>
                            @foreach ($categories as $item)
                                <li class="{{ $active_id == $item->id ? 'active' : '' }}">
                                    <a href="{{ url('products' . '/' . $item->name) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                            {{-- Sort dropdown --}}
                            <form method="GET" action="{{ url()->current() }}">
                                @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <div class="form-group mb-0">
                                    <label for="sort" class="mr-1">Sort by:</label>
                                    <select name="sort" id="sort" onchange="this.form.submit()"
                                        class="form-control d-inline-block w-auto">
                                        <option value="">Default</option>
                                        <option value="price_asc"
                                            {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to
                                            High
                                        </option>
                                        <option value="price_desc"
                                            {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to
                                            Low
                                        </option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            Name: A to Z</option>
                                        <option value="name_desc"
                                            {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @if ($products->count())
                    @foreach ($products as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 text-center">
                            <div class="single-product-item h-100 d-flex flex-column">
                                {{-- Image --}}
                                <div class="product-image flex-grow-1">
                                    <a href="{{ route('productDetails', ['id' => $item->id]) }}">
                                        <img src="{{ asset($item->firstImage->name) }}" class="img-fluid w-100"
                                            style="max-height: 250px; max-width: 100%; width: auto; height: auto; object-fit: contain;"
                                            alt="{{ $item->name }}">
                                    </a>
                                </div>
                                {{-- Content --}}
                                <div class="product-content p-3 d-flex flex-column">
                                    {{-- Name --}}
                                    <h3 class="product-name mb-2 text-truncate">{{ $item->name }}</h3>
                                    {{-- Price --}}
                                    <p class="product-price mb-3 font-weight-bold">
                                        {{ number_format($item->price, 2) }}
                                        $</p>
                                    {{-- Add to Cart --}}
                                    <div class="mt-auto">
                                        <a href="cart.html" class="cart-btn btn btn-block mb-2">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </a>
                                        @auth
                                            @if (auth()->user()->adminOrOwner())
                                                <div class="admin-actions d-flex justify-content-between">
                                                    {{-- Edit --}}
                                                    <a href="{{ route('editProduct', $item->id) }}"
                                                        class="btn btn-info btn-sm flex-grow-1 mr-1">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    {{-- Delete --}}
                                                    <button class="btn btn-danger btn-sm flex-grow-1 ml-1"
                                                        onclick="showDeleteDialog({{ $item->id }})"> Delete
                                                    </button>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class=" col-lg-12 col-md-6 text-center">
                        <h4>No result found</h4>
                    </div>
                @endif
            </div>
            {{-- Delete dialog --}}
            @auth
                @if (auth()->user()->adminOrOwner())
                    <dialog id="delete-dialog">
                        <div class="dialog-content">
                            <div class="dialog-header">
                                <h3 id="dialog-title">Delete Confirmation</h3>
                                <button class="close-btn" onclick="closeDialog()">&times;</button>
                            </div>
                            <div class="dialog-body">
                                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
                            </div>
                            <div class="dialog-footer">
                                <button class="btn-cancel" onclick="closeDialog()">Cancel</button>
                                <a href="" id="delete-link" class="btn-delete">Delete</a>
                            </div>
                        </div>
                    </dialog>
                @endif
            @endauth
            {{-- End Delete dialog --}}
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        {{ $products->appends(request()->only('search'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
    <x-logo_carousel></x-logo_carousel>
    @push('custom-js')
        <script>
            if (window.history.replaceState) {
                const url = new URL(window.location);
                if (url.searchParams.has('_token')) {
                    url.searchParams.delete('_token');
                    const newUrl = url.pathname + (url.searchParams.toString() ? '?' + url.searchParams.toString() : '');
                    window.history.replaceState({}, document.title, newUrl);
                }
            }

            $(document).ready(function() {
                $('#DeleteModal').on('show.bs.modal', function(event) {
                    // Get the button that triggered the modal
                    const button = $(event.relatedTarget);

                    // Extract info from data attributes
                    const productName = button.data('product-name');
                    const deleteUrl = button.data('delete-url');

                    // Update the modal content
                    $(this).find('#productName').text(productName);
                    $(this).find('#deleteLink').attr('href', deleteUrl);
                });
            });

            const dialog = document.querySelector('#delete-dialog');
            const dialogAction = document.querySelector('#delete-link');
            const deleteRouteTemplate = "{{ route('deleteProduct', ':id') }}";

            function showDeleteDialog(itemId) {
                dialogAction.href = deleteRouteTemplate.replace(':id', itemId);
                dialog.showModal();
            }

            function closeDialog() {
                dialog.close();
            }
        </script>
    @endpush
</x-layout>
