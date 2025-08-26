document.addEventListener('DOMContentLoaded', function () {
    // Initialize all tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Check screen size responsively
    const isMobile = window.matchMedia("(max-width: 768px)").matches;

    // Update label text
    document.querySelectorAll('.tooltip-text').forEach(function (el) {
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

$(document).ready(function () {
    // Initialize DataTable first
    $('#ProductsTable').DataTable();

    $(document).on('click', '[data-target="#ImagesModal"]', function () {
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

$(document).ready(function () {
    $('#image-upload-form').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    alert('Images uploaded successfully!');
                    closeImageDialog();
                    // Optional: Refresh the page or update the image list
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseJSON?.message || 'Something went wrong');
            }
        });
    });
});