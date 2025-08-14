<x-dash_layout>
    @push('custom-css')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('panel_assets/css/dialog.css') }}">
    @endpush
    <x-slot:title>products</x-slot:title>

    <div class="table-responsive w-75 m-auto">
        <table id="ProductsTable" class="table table-striped table-bordered table-hover text-center align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        {{-- name --}}
                        <td>{{ $item->name }}</td>
                        {{-- price --}}
                        <td class="text-truncate" style="max-width: 100px;">{{ $item->price }}</td>
                        {{-- quantity --}}
                        <td class="text-truncate" style="max-width: 100px;">{{ $item->quantity }}</td>
                        {{-- category --}}
                        <td class="text-truncate" style="max-width: 100px;">{{ $item->category->name }}</td>
                        {{-- images --}}
                        <td style="max-width: 140px;">
                            <!-- Button trigger modal -->
                            @php
                                $imageData = $item->images
                                    ->where('name', '!=', null)
                                    ->where('name', '!=', '')
                                    ->map(function ($image) use ($item) {
                                        return [
                                            'url' => asset($image->name),
                                            'alt' => $item->name,
                                            'delete' => route('deleteProductImage', $image->id),
                                        ];
                                    });
                            @endphp

                            <button type="button" class="btn btn-primary btn-sm ml-1" data-toggle="modal"
                                data-target="#ImagesModal" data-name="{{ $item->name }}"
                                data-images='@json($imageData)'>
                                Show
                            </button>
                            <button class="btn btn-sm btn-success"
                                onclick="AddImageForm({{ $item->id }}, '{{ $item->name }}')">Add</button>
                        </td>
                        {{-- description --}}
                        <td>
                            <span id="desc-label-{{ $item->id }}" class="d-inline-block text-truncate tooltip-text"
                                style="max-width: 150px;" data-bs-toggle="tooltip" title="{{ $item->description }}">
                                Hover to show
                            </span>
                        </td>
                        {{-- actions --}}
                        <td>
                            <a href="{{ route('editProduct', $item->id) }}">
                                <button class="btn btn-sm btn-info">Edit</button>
                            </a>
                            {{-- Delete --}}
                            <button class="btn btn-sm btn-danger"
                                onclick="showDeleteDialog({{ $item->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Images Modal -->
    <div class="modal fade " id="ImagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagesModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Carousel --}}
                    <div id="ImageSlider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" id="carouselItems"></div>

                        <a class="carousel-control-prev" href="#ImageSlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#ImageSlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    {{-- End Carousel --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Images Modal --}}




    {{-- Add Image dialog --}}
    <dialog id="Add-Image-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <h3 id="dialog-title">Add Image</h3>
                <button type="button" class="close-btn" onclick="closeImageDialog()">&times;</button>
            </div>
            <div class="dialog-body">
                <form id="image-upload-form" action="{{ route('addProductImage') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" name="images[]" id="image-upload" multiple required>
                    </div>
                    <div id="product-image-info"></div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                    <div class="dialog-footer mt-3">
                        <button type="button" class="btn-cancel" onclick="closeImageDialog()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    {{-- End Add Image dialog --}}





    {{-- Delete dialog --}}
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
    {{-- End Delete dialog --}}
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a class="btn btn-primary" href="{{ route('addProducts') }}">Add Product</a>
        </div>
    </div>
    @push('custom-js')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize all tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Check screen size responsively
                const isMobile = window.matchMedia("(max-width: 768px)").matches;

                // Update label text
                document.querySelectorAll('.tooltip-text').forEach(function(el) {
                    if (isMobile) {
                        el.textContent = "Tap to show";
                    } else {
                        el.textContent = "Hover to show";
                    }
                });
            });

            // Add Image Form
            const AddImageDialog = document.querySelector('#Add-Image-dialog');
            const InputsDiv = document.querySelector('#product-image-info');

            function AddImageForm(itemId, itemName) {
                let inputsHtml = `
        <input type="hidden" name="product_name" value="${itemName}">
        <input type="hidden" name="product_id" value="${itemId}">
    `;
                $('#product-image-info').html(inputsHtml);
                AddImageDialog.showModal();
            }

            function closeImageDialog() {
                AddImageDialog.close();
                // Reset the form when closing
                document.getElementById('image-upload-form').reset();
            }

            // Delete Image dialog
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

            $(document).ready(function() {
                // Initialize DataTable first
                $('#ProductsTable').DataTable();

                $(document).on('click', '[data-target="#ImagesModal"]', function() {
                    const button = $(this);
                    const name = button.data('name');
                    const imagesData = button.data('images');

                    let images = [];
                    if (Array.isArray(imagesData)) {
                        images = imagesData;
                    }

                    // Update modal
                    $('#imagesModalLabel').text('Images for ' + (name || 'Product'));

                    // Build Carousel
                    let carouselHtml = '';
                    if (images.length) {
                        images.forEach((image, index) => {
                            carouselHtml += `
                <div class="carousel-item text-center ${index === 0 ? 'active' : ''}">
                    <img src="${image.url}" class="d-block w-100" alt="${image.alt || 'Product Image'}">
                    <a href="${image.delete}" class="btn btn-danger mt-2 w-50">Delete</a>
                </div>
            `
                        });
                    } else {
                        carouselHtml = '<div class="alert alert-info">No images available</div>';
                    }

                    $('#carouselItems').html(carouselHtml);
                });

            });

            $(document).ready(function() {
                $('#image-upload-form').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                alert('Images uploaded successfully!');
                                closeImageDialog();
                                // Optional: Refresh the page or update the image list
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseJSON?.message || 'Something went wrong');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-dash_layout>
