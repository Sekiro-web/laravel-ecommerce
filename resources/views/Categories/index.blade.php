<x-dash_layout>
    @push('custom-css')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('panel_assets/css/dialog.css') }}">
    @endpush
    <x-slot:title>products</x-slot:title>

    <div class="table-responsive col-md-12 col-lg-9 m-auto">
        <table id="CategoryTable" class="table table-striped table-bordered table-hover text-center align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        {{-- name --}}
                        <td>{{ $item->name }}</td>
                        {{-- image --}}
                        <td class="text-truncate" style="max-width: 100px;">
                            <!-- Button trigger modal -->
                            @php
                                $imageData = [
                                    'url' => asset($item->imgpath),
                                    'alt' => $item->name,
                                ];
                            @endphp
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#ImagesModal" data-name="{{ $item->name }}"
                                data-images='@json($imageData)'>Show
                            </button>
                        </td>
                        {{-- Date --}}
                        <td>{{ $item->created_at }}</td>
                        {{-- actions --}}
                        <td>
                            @if (auth()->user()->isOwner())
                                <div class="btn-group" role="group">
                                    <a class="btn btn-sm btn-primary" href="{{ route('editCategory', $item->id) }}">
                                        Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="showDeleteDialog({{ $item->id }})">Delete</button>
                                </div>
                            @else
                                No action allowed
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



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
                    <div class="modal-body" id="modal-items">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Images Modal --}}




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
    </div>


    @if (auth()->user()->isOwner())
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('addCategory') }}" class="btn btn-primary"> Add Category </a>
            </div>
        </div>
    @endif
    @push('custom-js')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#CategoryTable').DataTable();
            });

            // Delete dialog
            const dialog = document.querySelector('#delete-dialog');
            const dialogAction = document.querySelector('#delete-link');
            const deleteRouteTemplate = "{{ route('deleteCategory', ':id') }}";

            function showDeleteDialog(itemId) {
                dialogAction.href = deleteRouteTemplate.replace(':id', itemId);
                dialog.showModal();
            }

            function closeDialog() {
                dialog.close();
            }

            $(document).ready(function() {

                $(document).on('click', '[data-target="#ImagesModal"]', function() {
                    const button = $(this);
                    const name = button.data('name');
                    const imagesData = button.data('images');

                    let images = [];
                    if (Array.isArray(imagesData)) {
                        images = imagesData;
                    } else if (imagesData && typeof imagesData === 'object') {
                        images = [imagesData];
                    }

                    // Update modal
                    $('#imagesModalLabel').text('Images for ' + (name || 'Category'));

                    // Build Carousel
                    let carouselHtml = '';
                    if (images.length) {
                        images.forEach((image, index) => {
                            carouselHtml += `
                    <img src="${image.url}" class="d-block w-100" alt="${image.alt || 'Category Image'}">`
                        });

                    } else {
                        carouselHtml = '<div class="alert alert-info">No images available</div>';
                    }

                    $('#modal-items').html(carouselHtml);
                });

            });
        </script>
        <script src="{{ asset('panel_assets/js/custom/category-index.js') }}"></script>
    @endpush
</x-dash_layout>
